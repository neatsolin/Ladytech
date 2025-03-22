
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .main-content {
            padding: 2rem;
        }
        .header h2 {
            font-weight: 600;
            color: #343a40;
        }
        .header h2 span {
            color: #6c757d;
            font-weight: 400;
        }
        .table th {
            background-color: #f1f3f5;
            color: #495057;
            font-weight: 600;
        }
        .file-icon {
            font-size: 1.2rem;
        }
        .checkbox {
            width: 2rem;
        }
        .actions-column {
            width: 6rem;
            text-align: center;
        }
        .row-action-btn {
            padding: 0.25rem 0.5rem;
            font-size: 1rem;
            transition: transform 0.1s ease;
        }
        .row-action-btn:hover {
            transform: scale(1.1);
        }
        /* Responsive adjustments for 768px and below */
        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            .header h2 {
                font-size: 1.2rem;
            }
            .header .search-bar {
                width: 100% !important;
            }
            .action-buttons {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 0.5rem !important;
                justify-content: center;
            }
            .action-buttons .btn {
                font-size: 0.85rem;
                padding: 0.4rem 0.6rem;
                flex: 1 1 auto;
                max-width: 150px; 
                white-space: nowrap;
                text-align: center;
            }
            .table th, .table td {
                font-size: 0.85rem;
                padding: 0.5rem 0.3rem;
            }
            .file-icon {
                font-size: 1rem;
            }
            .checkbox {
                width: 1.5rem;
            }
            .actions-column {
                width: 4.5rem;
            }
            .row-action-btn {
                padding: 0.15rem 0.3rem;
                font-size: 0.85rem;
            }
            .table th:nth-child(2), .table td:nth-child(2) {
                width: 2.5rem;
            }
            .table th:nth-child(3), .table td:nth-child(3) {
                width: 40%;
            }
            .table th:nth-child(4), .table td:nth-child(4) {
                width: 30%;
            }
        }
    </style>
</head>
<body>
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 flex-wrap gap-2">
            <h2 class="mb-0">OneDrive <span>></span> Recycle Bin</h2>
            <div class="col-md-4 col-lg-3 search-bar">
                <input type="text" class="form-control rounded-pill shadow-sm" placeholder="Search everything">
            </div>
        </div>

        <!-- Actions -->
        <div class="action-buttons d-flex flex-wrap gap-2 mb-4">
            <button class="btn btn-outline-primary shadow-sm" onclick="restoreSelected()" id="restoreBtn" disabled>
                <i class="fas fa-undo me-2"></i> Restore Selection
            </button>
            <button class="btn btn-outline-danger shadow-sm" onclick="deleteSelected()" id="deleteBtn" disabled>
                <i class="fas fa-trash me-2"></i> Delete Selection
            </button>
            <button class="btn btn-danger shadow-sm" onclick="emptyRecycleBin()" id="emptyBtn">
                <i class="fas fa-trash-alt me-2"></i> Empty Recycle Bin
            </button>
        </div>

        <!-- Recycle Bin Table -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0" id="recycleBinTable">
                        <thead>
                            <tr>
                                <th class="checkbox"><input type="checkbox" id="selectAll" class="form-check-input"></th>
                                <th>Type</th>
                                <th>Name</th>
                                <th class="d-none d-md-table-cell">Original Location</th>
                                <th>Deleted</th>
                                <th class="d-none d-md-table-cell">Size</th>
                                <th class="actions-column">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="recycleBinTableBody">
                            <!-- Deleted files will be dynamically added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
 // Sample data for deleted files
let deletedFiles = [
    {
        type: "docx",
        name: "4sysops Test.docx",
        originalLocation: "/personal/kyle_trecker_mr_net/Documents",
        deletedBy: "Kyle Beckman",
        createdBy: "Kyle Beckman",
        deleted: "6/28/2014 6:55 PM",
        size: "125.4 KB"
    },
    {
        type: "txt",
        name: "test",
        originalLocation: "/personal/kyle_trecker_mr_net/Documents",
        deletedBy: "Kyle Beckman",
        createdBy: "Kyle Beckman",
        deleted: "6/1/2014 4:49 PM",
        size: "< 1 KB"
    },
    {
        type: "png",
        name: "Capture.PNG",
        originalLocation: "/personal/kyle_trecker_mr_net/Documents",
        deletedBy: "Kyle Beckman",
        createdBy: "Kyle Beckman",
        deleted: "6/1/2014 4:49 PM",
        size: "543.7 KB"
    }
];

// Function to get the appropriate Font Awesome icon based on file type
function getFileIcon(type) {
    switch (type.toLowerCase()) {
        case "docx":
            return '<i class="fas fa-file-word file-icon text-primary"></i>'; 
        case "txt":
            return '<i class="fas fa-file-alt file-icon text-secondary"></i>'; 
        case "png":
            return '<i class="fas fa-file-image file-icon text-success"></i>'; 
        default:
            return '<i class="fas fa-file file-icon text-muted"></i>';
    }
}

// Function to create action buttons for each row
function createActionButtons(index) {
    return `
        <button class="row-action-btn restore text-success" onclick="restoreFile(${index})" data-bs-toggle="tooltip" data-bs-placement="top" title="Restore">
            <i class="fas fa-undo"></i>
        </button>
        <button class="row-action-btn delete text-danger" onclick="deleteFile(${index})" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Permanently">
            <i class="fas fa-trash"></i>
        </button>
    `;
}

// Function to render deleted files in the table
function renderDeletedFiles() {
    const tableBody = document.getElementById("recycleBinTableBody");
    tableBody.innerHTML = "";

    deletedFiles.forEach((file, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td class="checkbox"><input type="checkbox" class="fileCheckbox form-check-input" data-index="${index}"></td>
            <td>${getFileIcon(file.type)}</td>
            <td>${file.name}</td>
            <td class="d-none d-md-table-cell">${file.originalLocation}</td>
            <td>${file.deleted}</td>
            <td class="d-none d-md-table-cell">${file.size}</td>
            <td class="actions-column">${createActionButtons(index)}</td>
        `;
        tableBody.appendChild(row);
    });

    // Initialize Bootstrap tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(tooltipTriggerEl => {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Update button states
    updateButtonStates();
}

// Function to restore a single file
function restoreFile(index) {
    if (confirm(`Are you sure you want to restore "${deletedFiles[index].name}"?`)) {
        deletedFiles.splice(index, 1);
        renderDeletedFiles();
    }
}

// Function to permanently delete a single file
function deleteFile(index) {
    if (confirm(`Are you sure you want to permanently delete "${deletedFiles[index].name}"?`)) {
        deletedFiles.splice(index, 1);
        renderDeletedFiles();
    }
}

// Function to update the state of the Restore and Delete buttons
function updateButtonStates() {
    const checkboxes = document.querySelectorAll(".fileCheckbox:checked");
    const restoreBtn = document.getElementById("restoreBtn");
    const deleteBtn = document.getElementById("deleteBtn");
    const emptyBtn = document.getElementById("emptyBtn");

    restoreBtn.disabled = checkboxes.length === 0;
    deleteBtn.disabled = checkboxes.length === 0;
    emptyBtn.disabled = deletedFiles.length === 0;
}

// Function to restore selected files
function restoreSelected() {
    const checkboxes = document.querySelectorAll(".fileCheckbox:checked");
    const indices = Array.from(checkboxes).map(checkbox => parseInt(checkbox.dataset.index)).sort((a, b) => b - a);

    if (indices.length > 0 && confirm("Are you sure you want to restore the selected files?")) {
        indices.forEach(index => {
            deletedFiles.splice(index, 1);
        });
        renderDeletedFiles();
    }
}

// Function to permanently delete selected files
function deleteSelected() {
    const checkboxes = document.querySelectorAll(".fileCheckbox:checked");
    const indices = Array.from(checkboxes).map(checkbox => parseInt(checkbox.dataset.index)).sort((a, b) => b - a);

    if (indices.length > 0 && confirm("Are you sure you want to permanently delete the selected files?")) {
        indices.forEach(index => {
            deletedFiles.splice(index, 1);
        });
        renderDeletedFiles();
    }
}

// Function to empty the Recycle Bin
function emptyRecycleBin() {
    if (deletedFiles.length > 0 && confirm("Are you sure you want to empty the Recycle Bin? This action cannot be undone.")) {
        deletedFiles = [];
        renderDeletedFiles();
    }
}

// Select all checkboxes
document.getElementById("selectAll").addEventListener("change", function () {
    const checkboxes = document.querySelectorAll(".fileCheckbox");
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
    updateButtonStates();
});

// Add event listener for individual checkboxes
document.addEventListener("change", function (e) {
    if (e.target.classList.contains("fileCheckbox")) {
        updateButtonStates();
    }
});

// Initial render of deleted files
document.addEventListener("DOMContentLoaded", renderDeletedFiles);
</script>