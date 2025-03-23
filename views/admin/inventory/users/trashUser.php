<style>
    .main-content {
        padding: 2rem;
        min-height: auto;
        overflow-y: visible;
    }

    .table-responsive {
        overflow: visible !important;
    }

    .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        border-radius: 0.25rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        min-width: 8rem;
        padding: 0.25rem 0;
        background-color: #fff;
        z-index: 1000;
        max-height: none;
        overflow: visible;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }

    .dropdown-item {
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
        transition: background-color 0.2s ease;
    }

    .dropdown-item i {
        margin-right: 0.75rem;
        width: 1.25rem;
        text-align: center;
    }

    .dropdown-item:hover {
        background-color: #f1f3f5;
    }



    .search-bar .input-group {
        border: 1px solid transparent;
        background: linear-gradient(to right, #fff, #fff) padding-box,
            linear-gradient(90deg, #007bff, #ff6f61) border-box;
        transition: all 0.3s ease;
    }


    .search-bar .input-group-text {
        background-color: transparent;
        border: none;
    }

    /* Responsive adjustments for 768px and below */
    /* Responsive adjustments for screens 768px and below */
    @media (max-width: 768px) {

        /* Main content padding for better spacing */
        .main-content {
            padding: 1rem;
        }

        /* Header adjustments */
        .header h2 {
            font-size: 1.2rem;
            line-height: 1.4;
            /* Improves readability */
        }

        .header .search-bar {
            width: 100% !important;
            /* Full width for smaller screens */
        }

        /* Action buttons layout */
        .action-buttons {
            display: flex;
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
            border-radius: 0.25rem;
            /* Subtle rounding for aesthetics */
        }

        /* Table adjustments for compactness */
        .table th,
        .table td {
            font-size: 0.85rem;
            padding: 0.5rem 0.3rem;
            vertical-align: middle;
            /* Better alignment */
        }

        /* Icons and checkboxes */
        .file-icon {
            font-size: 1rem;
        }

        .checkbox {
            width: 1.5rem;
            height: 1.5rem;
            /* Consistent sizing */
        }

        /* Actions column width */
        .actions-column {
            width: 4.5rem;
        }

        .row-action-btn {
            padding: 0.15rem 0.3rem;
            font-size: 0.85rem;
            border-radius: 0.2rem;
            /* Slight rounding */
        }

        /* Dropdown menu styling */
        .dropdown-menu {
            min-width: 6rem;
            right: -10px;
            border-radius: 0.3rem;
            /* Softer corners */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
        }

        .dropdown-item {
            padding: 0.4rem 0.8rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            /* Aligns icon and text */
        }

        .dropdown-item i {
            margin-right: 0.5rem;
            width: 1rem;
            text-align: center;
            /* Centers icons */
        }

        /* Search bar enhancements */
        .search-bar .input-group {
            border-radius: 2rem !important;
        }

        .search-bar .form-control {
            padding: 0.6rem 1rem;
            font-size: 0.95rem;
            border: 1px solid #ced4da;
            /* Subtle border */
        }

        .search-bar .search-icon {
            font-size: 0.9rem;
            color: #6c757d;
            /* Muted color for icon */
        }
    }
</style>
</head>

<body>
    <div class="main-content">
        <div class="header d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 flex-wrap gap-2">
            <h2 class="mb-0">OneDrive <span>></span> Recycle Bin</h2>
            <div class="col-12 col-md-4 col-lg-3 search-bar">
                <div class="search-bar-wrapper position-relative">
                    <div class="input-group shadow-sm bg-white rounded-pill">
                        <span class="input-group-text bg-transparent border-0 pe-0" style="border-radius: 50rem 0 0 50rem;">
                            <i class="fas fa-search text-muted search-icon"></i>
                        </span>
                        <input type="text" id="searchInput" class="form-control border-0 rounded-pill py-2" placeholder="Search everything">
                    </div>
                </div>
            </div>
        </div>
        <div class="action-buttons d-flex flex-wrap gap-2 mb-4">
            <button class="btn btn-outline-primary shadow-sm" onclick="restoreSelected()" id="restoreBtn" disabled>
                <i class="fas fa-undo me-2"></i> Restore Selection
            </button>
            <button class="btn btn-outline-danger shadow-sm" onclick="deleteSelected()" id="deleteBtn" disabled>
                <i class="fas fa-trash me-2"></i> Delete Selection
            </button>
        </div>
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle mb-0" id="recycleBinTable">
                        <thead>
                            <tr>
                                <th class="checkbox"><input type="checkbox" id="selectAll" class="form-check-input"></th>
                                <th>Category</th>
                                <th>Name</th>
                                <th class="d-none d-md-table-cell">Original Location</th>
                                <th>Deleted</th>
                                <th class="actions-column">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="recycleBinTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        const deletedFiles = [{
                type: "docx",
                name: "4sysops Test.docx",
                originalLocation: "/personal/kyle_trecker_mr_net/Documents",
                deleted: "6/28/2014 6:55 PM"
            },
            {
                type: "txt",
                name: "test.txt",
                originalLocation: "/personal/kyle_trecker_mr_net/Documents",
                deleted: "6/1/2014 4:49 PM"
            },
            {
                type: "png",
                name: "Capture.PNG",
                originalLocation: "/personal/kyle_trecker_mr_net/Documents",
                deleted: "6/1/2014 4:49 PM"
            },
            {
                type: "pdf",
                name: "Report_2023.pdf",
                originalLocation: "/personal/kyle_trecker_mr_net/Documents/Reports",
                deleted: "7/15/2023 9:30 AM"
            },
            {
                type: "xlsx",
                name: "Budget.xlsx",
                originalLocation: "/personal/kyle_trecker_mr_net/Documents/Finance",
                deleted: "8/10/2023 2:15 PM"
            },
            {
                type: "jpg",
                name: "Vacation_Photo.jpg",
                originalLocation: "/personal/kyle_trecker_mr_net/Pictures",
                deleted: "9/5/2023 11:45 AM"
            },
            {
                type: "docx",
                name: "Meeting_Notes.docx",
                originalLocation: "/personal/kyle_trecker_mr_net/Documents/Meetings",
                deleted: "10/20/2023 3:20 PM"
            },
            {
                type: "txt",
                name: "Ideas.txt",
                originalLocation: "/personal/kyle_trecker_mr_net/Documents/Notes",
                deleted: "11/1/2023 8:00 AM"
            },
            {
                type: "png",
                name: "Screenshot_2023.png",
                originalLocation: "/personal/kyle_trecker_mr_net/Screenshots",
                deleted: "12/12/2023 5:10 PM"
            },
            {
                type: "pdf",
                name: "Invoice_001.pdf",
                originalLocation: "/personal/kyle_trecker_mr_net/Documents/Invoices",
                deleted: "1/25/2024 10:30 AM"
            },
            {
                type: "xlsx",
                name: "Sales_Data.xlsx",
                originalLocation: "/personal/kyle_trecker_mr_net/Documents/Sales",
                deleted: "2/14/2024 1:50 PM"
            },
            {
                type: "jpg",
                name: "Family_Photo.jpg",
                originalLocation: "/personal/kyle_trecker_mr_net/Pictures",
                deleted: "3/30/2024 7:25 PM"
            },
            {
                type: "docx",
                name: "Project_Plan.docx",
                originalLocation: "/personal/kyle_trecker_mr_net/Documents/Projects",
                deleted: "4/18/2024 4:40 PM"
            }
        ];

        function getFileIcon(type) {
            switch (type.toLowerCase()) {
                case "docx":
                    return '<i class="fas fa-file-word file-icon text-primary"></i>';
                case "txt":
                    return '<i class="fas fa-file-alt file-icon text-secondary"></i>';
                case "png":
                    return '<i class="fas fa-file-image file-icon text-success"></i>';
                case "pdf":
                    return '<i class="fas fa-file-pdf file-icon text-danger"></i>';
                case "xlsx":
                    return '<i class="fas fa-file-excel file-icon text-success"></i>';
                case "jpg":
                    return '<i class="fas fa-file-image file-icon text-warning"></i>';
                default:
                    return '<i class="fas fa-file file-icon text-muted"></i>';
            }
        }

        function createActionButtons(index) {
            return `
                <div class="dropdown">
                    <button class="btn btn-link text-muted p-0">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item text-success" href="#" onclick="restoreFile(${index}); return false;">
                                <i class="fas fa-undo"></i> Restore
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item text-danger" href="#" onclick="deleteFile(${index}); return false;">
                                <i class="fas fa-trash"></i> Delete
                            </a>
                        </li>
                    </ul>
                </div>
            `;
        }

        function renderDeletedFiles() {
            const tableBody = document.getElementById("recycleBinTableBody");
            const searchQuery = document.getElementById("searchInput").value.trim().toLowerCase();


            const filteredFiles = deletedFiles.filter(file =>
                file.name.toLowerCase().includes(searchQuery) ||
                file.type.toLowerCase().includes(searchQuery) ||
                file.originalLocation.toLowerCase().includes(searchQuery) ||
                file.deleted.toLowerCase().includes(searchQuery)
            );

            tableBody.innerHTML = "";

            filteredFiles.forEach((file, index) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td class="checkbox"><input type="checkbox" class="fileCheckbox form-check-input" data-index="${deletedFiles.indexOf(file)}"></td>
                    <td>${getFileIcon(file.type)}</td>
                    <td>${file.name}</td>
                    <td class="d-none d-md-table-cell">${file.originalLocation}</td>
                    <td>${file.deleted}</td>
                    <td class="actions-column">${createActionButtons(deletedFiles.indexOf(file))}</td>
                `;
                tableBody.appendChild(row);
            });

            updateButtonStates();
        }

        function restoreFile(index) {
            if (confirm(`Are you sure you want to restore "${deletedFiles[index].name}"?`)) {
                deletedFiles.splice(index, 1);
                renderDeletedFiles();
            }
        }

        function deleteFile(index) {
            if (confirm(`Are you sure you want to permanently delete "${deletedFiles[index].name}"?`)) {
                deletedFiles.splice(index, 1);
                renderDeletedFiles();
            }
        }

        function updateButtonStates() {
            const checkboxes = document.querySelectorAll(".fileCheckbox:checked");
            const restoreBtn = document.getElementById("restoreBtn");
            const deleteBtn = document.getElementById("deleteBtn");

            restoreBtn.disabled = checkboxes.length === 0;
            deleteBtn.disabled = checkboxes.length === 0;
        }

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

        document.getElementById("selectAll").addEventListener("change", function() {
            const checkboxes = document.querySelectorAll(".fileCheckbox");
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateButtonStates();
        });

        document.addEventListener("change", function(e) {
            if (e.target.classList.contains("fileCheckbox")) {
                updateButtonStates();
            }
        });

        document.getElementById("searchInput").addEventListener("input", function() {
            renderDeletedFiles();
        });

        document.addEventListener("DOMContentLoaded", renderDeletedFiles);
    </script>