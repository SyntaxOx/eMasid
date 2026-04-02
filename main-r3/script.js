/**
 * BARANGAY CONCERN REPORTS - Admin Logic
 */
let currentReportId = null;

// 1. DATA SOURCE (Pwedeng manggaling sa API soon)
const reports = [
    {
        id: "#BRGY-2024-001",
        type: "Waste Management",
        resident: "Kyla Basa",
        phone: "0917-123-4567",
        address: "Zone 1, Brgy. Hall Street",
        date: "2026-01-24",
        status: "Pending",
        description: "Garbage not collected for 3 days. The smell is affecting the nearby daycare.",
        location: "Near the Park",
        assigned: "None",
        images: ["https://via.placeholder.com/150"]
    },
    {
        id: "#BRGY-2024-002",
        type: "Street Lighting",
        resident: "Michelle Gatchalian",
        phone: "0918-999-8888",
        address: "Block 12, Sampaguita",
        date: "2026-01-23",
        status: "Resolved",
        description: "Multiple street lights are broken in this section of the park.",
        location: "Sampaguita St. Corner",
        assigned: "Maintenance Team B",
        images: ["https://via.placeholder.com/150", "https://via.placeholder.com/150"]
    },
    // ITO YUNG PANGATLO:
    {
        id: "#BRGY-2024-003",
        type: "Drainage Issue",
        resident: "Xiena Daquioag",
        phone: "0920-111-2222",
        address: "Sitio Matahimik",
        date: "2026-01-25",
        status: "In-Progress",
        description: "Clogged drainage causing minor flooding even with light rain.",
        location: "Front of Brgy. Outpost",
        assigned: "Maintenance Alpha",
        images: ["https://via.placeholder.com/150"]
    }
];

// 2. SELECTORS
const elements = {
    modal: document.getElementById('reportModal'),
    tableBody: document.querySelector('tbody'),
    tabButtons: document.querySelectorAll('.tab-btn'),
    sortFilter: document.getElementById('sortFilter'),
    closeX: document.getElementById('closeModalX'),
    // Modal Content Fields
    modalRef: document.querySelector('#reportModal .text-error'),
    modalResident: document.querySelector('.detail-box p.font-bold'),
    modalDesc: document.querySelector('.bg-surface.p-4')
};

// 3. MODAL CONTROLLERS
const modalActions = {
    open: (reportId) => {
    currentReportId = reportId; 

    const report = reports.find(r => r.id === reportId);
    if (report) populateModal(report);
    
    elements.modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
},
    close: () => {
        elements.modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
};

// 4. CORE FUNCTIONS
function renderTable(dataToRender) {
    elements.tableBody.innerHTML = ''; // Nililinis ang table bago mag-add
    dataToRender.forEach(report => {
        // Tukuyin ang kulay ng pill base sa status
        let pillClass = report.status === "Resolved" ? "green-pill" : 
                        report.status === "In-Progress" ? "blue-pill" : "orange-circle";

        const row = `
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="px-8 py-6 font-bold text-error">${report.id}</td>
                <td class="px-8 py-6 font-semibold">${report.type}</td>
                <td class="px-8 py-6 text-on-surface-variant">${report.resident}</td>
                <td class="px-8 py-6 text-on-surface-variant">${report.date}</td>
                <td class="px-8 py-6"><span class="status-pill ${pillClass}">${report.status}</span></td>
                <td class="px-8 py-6 text-right">
                    <button class="view-details-btn text-primary font-bold hover:underline">View Details</button>
                </td>
            </tr>`;
        elements.tableBody.insertAdjacentHTML('beforeend', row);
    });
}
function updateStatusCounts() {
    const counts = {
        all: reports.length,
        pending: reports.filter(r => r.status === "Pending").length,
        inProgress: reports.filter(r => r.status === "In-Progress").length,
        resolved: reports.filter(r => r.status === "Resolved").length
    };

    // Ito ang nag-uupdate ng numbers sa mga bilog (tabs) sa itaas
    document.querySelector('#tab-all span').innerText = counts.all;
    document.querySelector('#tab-pending span').innerText = counts.pending;
    document.querySelector('#tab-progress span').innerText = counts.inProgress;
    document.querySelector('#tab-resolved span').innerText = counts.resolved;

    // Para sa footer text sa ibaba
    const showingRange = document.getElementById('showing-range');
    const totalResults = document.getElementById('total-results');
    
    if (showingRange) showingRange.innerText = `1 - ${counts.all}`;
    if (totalResults) totalResults.innerText = counts.all;
}


// I-update ang laman ng Modal base sa clinick na report
function populateModal(report) {
    // Gamitin ang optional chaining (?.) para hindi mag-error kung null ang element
    if (elements.modalRef) elements.modalRef.innerText = report.id;
    if (elements.modalDesc) elements.modalDesc.innerText = `"${report.description}"`;

    // 1. Update Resident Details (Mas safe na approach)
    const residentBox = document.querySelector('.detail-box');
    if (residentBox) {
        const pTags = residentBox.querySelectorAll('p.text-sm');
        if (pTags[0]) pTags[0].innerText = report.phone;
        if (pTags[1]) pTags[1].innerText = report.address;
    }

    // 2. Update Location
    const locationPin = document.querySelector('.detail-box .text-sm.font-medium');
    if (locationPin) locationPin.innerText = report.location;

    // 3. Update Dropdowns
    const statusSelect = document.querySelector('.status-dropdown');
    if (statusSelect) statusSelect.value = report.status;

    const assignedSelect = document.querySelector('.assigned-dropdown');
    if (assignedSelect) {
        assignedSelect.value = report.assigned;
    }

    // 4. Update Images
    const imageContainer = document.querySelector('.flex.gap-3');
    if (imageContainer) {
        imageContainer.innerHTML = ''; 
        report.images.forEach(imgSrc => {
            const img = document.createElement('img');
            img.className = "w-24 h-24 object-cover rounded-lg border shadow-sm";
            img.src = imgSrc;
            imageContainer.appendChild(img);
        });
    }
}

// I-filter ang table rows
function filterTable(status) {
    const rows = elements.tableBody.querySelectorAll('tr');
    rows.forEach(row => {
        const rowStatus = row.querySelector('.status-pill').innerText.toLowerCase();
        const filter = status.toLowerCase();
        
        if (filter === 'all' || rowStatus === filter) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Mag-sort ng table
function sortTable(criteria) {
    const rows = Array.from(elements.tableBody.querySelectorAll('tr'));
    
    rows.sort((a, b) => {
        const dateA = new Date(a.cells[3].innerText);
        const dateB = new Date(b.cells[3].innerText);

        return criteria === 'newest' ? dateB - dateA : dateA - dateB;
    });

    rows.forEach(row => elements.tableBody.appendChild(row));
}

//search bar
const searchInput = document.querySelector('.search-box input');

searchInput.addEventListener('input', (e) => {
    const term = e.target.value.toLowerCase();
    const rows = elements.tableBody.querySelectorAll('tr');

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(term) ? '' : 'none';
    });
});

// 5. EVENT LISTENERS

document.addEventListener('DOMContentLoaded', () => { 
    // 1. I-render ang table base sa 'reports' array mo
    renderTable(reports); 
    
    const activeTab = document.querySelector('.tab-btn.active');
if (activeTab) {
    const filterLabel = activeTab.innerText.split(' ')[0].toLowerCase();
    filterTable(filterLabel);
}
    // 2. I-update ang counts (ALL, Pending, etc.)
    updateStatusCounts();
    
    // Tab Filtering Logic
    elements.tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            elements.tabButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            
            const filterLabel = button.innerText.split(' ')[0].toLowerCase();
            filterTable(filterLabel);
        });
    });

    // Sorting Logic
    elements.sortFilter.addEventListener('change', (e) => sortTable(e.target.value));

   // Universal View Details Logic
document.addEventListener('click', (e) => {
    // Hanapin kung ang clinick ay ang button o kahit anong nasa loob nito
    const btn = e.target.closest('.view-details-btn');

    if (btn) {
        console.log("Button detected!"); // Magpapakita ito sa console pag gumana
        
        // Hanapin ang row kung nasaan ang button
        const row = btn.closest('tr');
        
        // Kunin ang ID (siguraduhing ito ang nasa unang column)
        const reportId = row.cells[0].innerText.trim();
        
        modalActions.open(reportId);
    }
    const saveNotesBtn = document.getElementById('saveNotesBtn');
const adminNotes = document.getElementById('adminNotes');

if (saveNotesBtn) {
    saveNotesBtn.addEventListener('click', () => {
        const note = adminNotes.value.trim();

        if (!note) {
        
            return;
        }

        console.log("Saved Note:", note);

        // OPTIONAL: idagdag sa activity log UI
        const activityLog = document.querySelector('.space-y-3');
        const today = new Date().toLocaleDateString('en-US', { month: 'short', day: 'numeric' });

        const newLog = document.createElement('li');
        newLog.className = "flex gap-2";
        newLog.innerHTML = `
            <span class="text-on-tertiary-container font-bold">• ${today}</span>
            <span class="text-gray-500">- Admin added note: "${note}"</span>
        `;

        activityLog.prepend(newLog);

        // Clear textarea after save
        adminNotes.value = "";

        alert("Note saved successfully!");
    });
}
const updateStatusBtn = document.getElementById('updateStatusBtn');

if (updateStatusBtn) {
    updateStatusBtn.addEventListener('click', () => {
        const statusSelect = document.querySelector('.status-dropdown');
        const assignedSelect = document.querySelector('.assigned-dropdown');

        const newStatus = statusSelect.value;
        const newAssigned = assignedSelect.value;

        // Hanapin yung report
        const report = reports.find(r => r.id === currentReportId);

        if (report) {
            report.status = newStatus;       // ✅ update status
            report.assigned = newAssigned;   // ✅ update assigned

            // Re-render table
            renderTable(reports);

            // Update counters
            updateStatusCounts();

            // Keep active filter
            const activeTab = document.querySelector('.tab-btn.active');
            if (activeTab) {
                const filterLabel = activeTab.innerText.split(' ')[0].toLowerCase();
                filterTable(filterLabel);
            }

            // ✅ Optional message (kung ginawa mo yung no-alert system)
            const msg = document.getElementById('statusMessage');
            if (msg) {
                msg.innerText = "Status & assignment updated!";
                msg.classList.remove('hidden');

                setTimeout(() => {
                    msg.classList.add('hidden');
                }, 2000);
            }
        }
    });
}
});

    // Modal Close Events
    elements.closeX.addEventListener('click', modalActions.close);
    
    window.addEventListener('click', (e) => {
        if (e.target === elements.modal) modalActions.close();
    });

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') modalActions.close();
    });
    // Kunin ang bagong button
const closeBtnBottom = document.getElementById('closeModalBottom');

// Idagdag ang click event
if (closeBtnBottom) {
    closeBtnBottom.addEventListener('click', () => {
        modalActions.close();
    });
}
});