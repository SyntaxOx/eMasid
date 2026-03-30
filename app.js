const reports = [
  {
    id: "#BRGY-2024-001",
    type: "Waste Management",
    resident: "Juan Dela Cruz",
    date: "Jan 24, 2026",
    status: "Pending"
  },
  {
    id: "#BRGY-2024-002",
    type: "Street Lights",
    resident: "Maria Santos",
    date: "Jan 20, 2026",
    status: "In-Progress"
  },
  {
    id: "#BRGY-2024-003",
    type: "Noise Complaint",
    resident: "Ana Luna",
    date: "Jan 19, 2026",
    status: "Pending"
  },
  {
    id: "#BRGY-2024-004",
    type: "Waste Management",
    resident: "Jillian Ruiz",
    date: "Jan 18, 2026",
    status: "Resolved"
  }
];

// Populate Table
const reportList = document.getElementById("report-list");
reportList.innerHTML = reports.map(
  r => `
  <tr>
    <td>${r.id}</td>
    <td>${r.type}</td>
    <td>${r.resident}</td>
    <td>${r.date}</td>
    <td><span class="status ${r.status.replace(' ', '-')}">${r.status}</span></td>
    <td><a href="#" class="view-link" data-id="${r.id}">View Details</a></td>
  </tr>`
).join("");

// Modal Behavior
const modal = document.getElementById("modal");
const closeModal = document.getElementById("closeModal");

document.querySelectorAll(".view-link").forEach(link => {
  link.addEventListener("click", e => {
    e.preventDefault();
    openModal(e.target.dataset.id);
  });
});

closeModal.addEventListener("click", () => modal.classList.add("hidden"));

// Placeholder modal content
function openModal(id) {
  const data = {
    name: "Maria Santos",
    contact: "0917-555-0123",
    address: "Block 12, Lot 5, Sampaguita Street",
    location: "Near the Park, Barangay Zone 2",
    date: "Jan 20, 2026",
    time: "8:30 AM",
    desc: "Multiple street lights are broken in this section of the park. It's very dark and feels unsafe.",
    images: ["[via.placeholder.com](https://via.placeholder.com/100)","[via.placeholder.com](https://via.placeholder.com/100)"]
  };

  document.getElementById("resName").textContent = data.name;
  document.getElementById("resContact").textContent = data.contact;
  document.getElementById("resAddress").textContent = data.address;
  document.getElementById("resLocation").textContent = data.location;
  document.getElementById("resDate").textContent = data.date;
  document.getElementById("resTime").textContent = data.time;
  document.getElementById("resDesc").textContent = data.desc;
  document.getElementById("resImages").innerHTML = data.images.map(src => `<img src="${src}" />`).join("");

  modal.classList.remove("hidden");
}

// Status update mock action
document.getElementById("changeStatus").addEventListener("click", () => {
  const status = document.getElementById("statusSelect").value;
  alert(`Status changed to: ${status}`);
});
