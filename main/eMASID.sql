-- ============================================================
-- 1. USERS  — core identity table
-- ============================================================
CREATE TABLE users (
    user_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,

    -- Resident identifier
    resident_id VARCHAR(20) NOT NULL UNIQUE,

    -- Personal info
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100) NULL,
    last_name VARCHAR(100) NOT NULL,
    suffix VARCHAR(10) NULL,
    gender ENUM('Male','Female','Other') NOT NULL,

    -- Contact
    mobile_number VARCHAR(15) NOT NULL UNIQUE,
    email VARCHAR(191) NOT NULL UNIQUE,

    -- Authentication
    password_hash VARCHAR(255) NOT NULL,
    last_password_changed DATETIME NULL,

    -- Email verification (token lives in otp_codes)
    email_verified_at DATETIME NULL,

    -- Account status
    status ENUM('pending','active','suspended','deactivated') NOT NULL DEFAULT 'pending',

    -- Audit
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME NULL,

    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_deleted_at (deleted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- 2. USER SECURITY  — 2FA & brute-force lockout (1-to-1)
-- ============================================================
CREATE TABLE user_security (
    user_id INT PRIMARY KEY NOT NULL,

    -- TOTP / 2FA
    two_factor_enabled TINYINT(1) NOT NULL DEFAULT 0,
    two_factor_secret VARCHAR(255) NULL,
    two_factor_verified_at DATETIME NULL,

    -- Brute-force lockout
    failed_login_attempts TINYINT UNSIGNED NOT NULL DEFAULT 0,
    last_failed_at DATETIME NULL,
    lockout_until DATETIME NULL,

    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- 3. PHILIPPINE LOCATIONS - Barangay
-- ============================================================
CREATE TABLE ph_locations (
    location_id  SMALLINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    barangay VARCHAR(100) NOT NULL,
    municipality VARCHAR(100) NOT NULL,
    province VARCHAR(100) NOT NULL,
    region VARCHAR(100) NULL,
    zip_code VARCHAR(10) NULL,

    UNIQUE KEY uq_barangay (barangay, municipality, province),
    INDEX idx_municipality (municipality),
    INDEX idx_province (province)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- 4. USER ADDRESSES  — Resident Address
-- ============================================================
CREATE TABLE user_addresses (
    address_id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    location_id SMALLINT UNSIGNED NOT NULL,
    house_no VARCHAR(20) NULL,
    street VARCHAR(100) NULL,
    years_of_residency SMALLINT UNSIGNED NULL,
    is_primary TINYINT(1) NOT NULL DEFAULT 1,

    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_user_id  (user_id),
    INDEX idx_location (location_id),
    FOREIGN KEY (user_id)     REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (location_id) REFERENCES ph_locations(location_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 5. USER LOGIN LOGS  — session audit trail (replaces both user_login_logs and login_attempts)
-- ============================================================
CREATE TABLE user_login_logs (
    log_id BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NULL,
    identifier VARCHAR(191) NOT NULL,
    login_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    logout_at DATETIME NULL,
    ip_address VARCHAR(45) NOT NULL,
    user_agent TEXT NULL,
    status ENUM('success','failed','locked') NOT NULL,
    failure_reason VARCHAR(100) NULL,
    session_token  VARCHAR(255) NULL,
    location VARCHAR(100) NULL,

    INDEX idx_user_id (user_id),
    INDEX idx_identifier (identifier),
    INDEX idx_login_at (login_at),
    INDEX idx_status (status),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- 6. OTP CODES  — multi-purpose; bcrypt-hashed codes
-- ============================================================
CREATE TABLE otp_codes (
    id BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    purpose ENUM('email_verify','login_2fa','password_reset','phone_verify') NOT NULL,
    code_hash VARCHAR(255) NOT NULL,
    channel ENUM('email','sms') NOT NULL DEFAULT 'email',
    expires_at DATETIME NOT NULL,
    used_at DATETIME NULL,
    attempts TINYINT UNSIGNED NOT NULL DEFAULT 0,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_user_id (user_id),
    INDEX idx_purpose (purpose),
    INDEX idx_expires (expires_at),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ============================================================
-- 7. USER HISTORY STATUS  — Check WHQ user ban or suspend
-- ============================================================
CREATE TABLE user_status_history (
    id BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    changed_by INT NOT NULL, -- Whose admin(not visible to user, only on admin)
    old_status ENUM('pending','active','suspended','deactivated') NOT NULL,
    new_status ENUM('pending','active','suspended','deactivated') NOT NULL,
    reason VARCHAR(255) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_user_id (user_id),
    FOREIGN KEY (user_id)    REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (changed_by) REFERENCES users(user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;