<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
    html,
    body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
    }

    .wrapper {
        min-height: 100%;
        display: flex;
        flex-direction: column;
    }

    .content {
        flex: 1;
    }

    .footer {
        padding: 0 !important;
        flex-shrink: 0;
    }
</style>

<style>
    /* body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fc;
        color: #333;
    } */

    body {
        font-family: 'Poppins' !important;
    }

    .bankstatement {
        position: relative;
        top: 70px;
        /* right: 20px; */
        z-index: 997;
        /* max-width: 300px; */
        width: 100%;
    }

    .dynamic {
        background-color: #eff3fe;
        position: relative;
        z-index: 998;
    }

    .dynamic p {
        color: #000;
        /* background-color: #f4f4f4; */
        font-size: 12px;
        padding: 0.4em 0em;
    }

    .container12 {
        max-width: 800px !important;
        margin: 0px 5px 80px 5px;
        /* margin: 20px auto; */
        padding: 10px;
        border-radius: 8px;
    }

    .bankstatement h1 {
        font-size: 25px !important;
        text-align: center;
        color: #273896 !important;
        font-weight: 600;
        margin-bottom: 20px !important;
    }

    .step {
        margin-bottom: 20px;
        /* margin-bottom: 30px; */
        /* padding: 15px; */
    }

    .clearfix::after {
        content: "";
        display: table;
        clear: both;
    }

    /* .step, */
    .step2,
    .step3 {
        margin-bottom: 30px;
        background: #c6cbcb3d;
        padding: 15px;
        width: 80%;
        /* Add min-height to maintain container size */
        min-height: 100px;
    }

    .step-header {
        display: flex;
        align-items: center;
        /* margin-bottom: 10px; */
    }

    .step-number {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1.5px solid #3a3a90;
        /* background: #3a3a90; */
        color: #3a3a90;
        /* color: #fff; */
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
        margin-right: 10px;
        font-weight: 700;
    }

    .step-title {
        font-size: 16px;
        font-weight: bold;
        font-weight: 600;
        color: #3a3a90;
    }

    .step-description {
        font-size: 9px;
        color: #858585;
        margin-top: -4px;
        /* margin-bottom: 15px; */
        float: inline-start;
        margin-left: 42px;
    }

    .upload-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .file-info {
        display: flex;
        gap: 10px;
        font-size: 14px;
        color: #666;
    }

    .add-file-input {
        display: none;
    }

    .upload-btn {
        display: inline-flex;
        align-items: center;
        /* padding: 10px 15px; */
        padding: 6px 16px;
        /* background: #ff4081; */
        color: #c71c8e;
        /* color: #fff; */
        font-size: 14px;
        font-weight: bold;
        /* border: none; */
        border: 1px solid #c71c8e;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }

    .upload-btn i {
        margin-right: 8px;
        font-size: 16px;
    }

    .upload-btn:hover {
        background-color: #c71c8e;
        color: #fff;
    }

    .action-btn {
        width: 20%;
        padding: 10px;
        background: #3a3a90;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 11px;
        cursor: pointer;
        text-align: center;
        float: left;
        margin-left: 37px;

    }

    .action-btn:hover {
        background: #2a2a6b;
    }

    .upload-table {
        width: 100%;
        border-collapse: separate;
        /* Change from collapse to separate */
        border-spacing: 0;
        /* Add this to maintain spacing */
        margin-top: 10px;
        overflow: hidden;
        /* Add this to ensure inner elements don't break radius */
        border-radius: 8px;
        /* Add desired border radius */
        border: 1px solid #ddd;
    }

    .upload-table thead:first-child tr:first-child th:first-child {
        border-top-left-radius: 8px;
    }

    .upload-table thead:first-child tr:first-child th:last-child {
        border-top-right-radius: 8px;
    }

    /* Style for last row's cells */
    .upload-table tbody tr:last-child td:first-child {
        border-bottom-left-radius: 8px;
    }

    .upload-table tbody tr:last-child td:last-child {
        border-bottom-right-radius: 8px;
    }

    .upload-table thead {
        /* border-bottom: 1px solid black;  */
        background-color: #fff !important;
    }



    /* .upload-table tr {
        border-radius: 2% !important;
        border: 1px solid #ddd;
        background-color: #f4f4f4;
    } */

    .upload-table th,
    .upload-table td {
        text-align: left;
        padding: 6px 10px;
        font-size: 14px;
        font-weight: 500;
        /* border-bottom: 1px solid #ddd; */
    }

    .upload-table td input {
        width: 100%;
        padding: 8px;
        font-size: 12px;
        /* border: 1px solid #ccc; */
        border-radius: 4px;
        border: none;
    }

    .upload-table .tusing input {
        width: 100%;
        color: #000;
        padding: 8px;
        font-size: 12px;
        font-weight: 400;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* .upload-table td input, */
    .upload-table td select {
        width: 100%;
        padding: 8px;
        font-size: 12px;
        font-weight: 400;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .upload-table td .save-btn {
        background-color: #28a745;
        color: white;
        padding: 11px 35px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .upload-table td .save-btn:hover {
        background-color: #218838;
    }

    .upload-table td .fa-trash {
        color: #d9534f;
        cursor: pointer;
        font-size: 18px;
        padding: 4px;
    }

    .upload-table td .fa-trash:hover {
        color: #c9302c;
    }

    @media (max-width: 768px) {

        /*
        .upload-table th:nth-child(1),
        .upload-table th:nth-child(2),
        .upload-table th:nth-child(3),
        .upload-table th:nth-child(4) {
            display: none;
        }

        .upload-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .upload-table th,
        .upload-table td {
            display: block;
            text-align: left;
            padding: 8px;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
        }

        .upload-table th {
            background-color: #f4f4f4;
            color: #555;
        }

        /* Label and value styling for stacked view */
        .upload-table td {
            position: relative;
            padding-left: 50%;
        }

        .upload-table td::before {
            content: attr(data-label);
            position: absolute;
            left: 10px;
            top: 10px;
            font-weight: bold;
            color: #333;
        }

        .upload-table td input,
        .upload-table td select {
            width: 100%;
            font-size: 14px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 5px;
        }

        */ .upload-btn {
            width: -webkit-fill-available;
            text-align: center;
            margin-bottom: 10px;
        }

        .step-header {
            flex-direction: column;
            text-align: center;
        }

        .step-number {
            margin-bottom: 10px;
        }

        .file-info {
            display: block;
            margin-top: 10px;
        }

        .action-btn {
            width: 100%;
            margin-left: 0;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .step {
            padding: 10px;
        }

        .upload-btn {
            font-size: 12px;
        }

        .action-btn {
            font-size: 12px;
        }
    }

    button:disabled,
    button:disabled:hover {
        background-color: #b6bcd8;
        cursor: not-allowed;
    }


    th,
    td {
        font-weight: 400 !important;
        font-size: 12px !important;
    }
</style>


<style>
    /* CSS for modal for upload statements of another bank account */
    .custom-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        /* display: flex; */
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 40px;
        border-radius: 8px;
        width: 90%;
        max-width: 500px;
        text-align: center;
    }

    .modal-content h2 {
        line-height: 1.5;
        font-size: 14px;
        margin-bottom: 30px;
        color: #000;
        font-weight: 400;
    }

    .modal-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .modal-btn {
        padding: 15px 0;
        width: 195px;
        height: 55px;
        border-radius: 8px;
        font-size: 20px;
        cursor: pointer;
        border: none;
    }

    .no-btn {
        background-color: white;
        color: #E91E63;
        border: 1px solid #E91E63;
    }

    .yes-btn {
        background-color: #273896;
        color: white;
        border: 1px solid #273896;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .modal-content {
            width: 85%;
            padding: 30px 20px;
        }

        .modal-content h2 {
            font-size: 20px;
            margin-bottom: 25px;
        }

        .modal-buttons {
            flex-direction: column;
            gap: 15px;
        }

        .modal-btn {
            width: 100%;
            padding: 12px 0;
        }
    }
</style>


<style>
    /* Loading Modal Styles */
    .loading-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        /* display: flex; */
        justify-content: center;
        align-items: center;
    }

    .loading-modal .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 20px;
        width: 90%;
        max-width: 370px;
        text-align: center;
    }

    .loading-modal h2 {
        font-size: 17px;
        color: #000;
        font-weight: normal;
        line-height: 1.5;
        margin-top: 40px;
    }

    /* Spinner Animation */
    .spinner {
        width: 85px;
        height: 85px;
        margin-top: 10px !important;
        margin: 0 auto;
        border: 6px solid #273896;
        border-top: 4px solid #f3f3f3;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .loading-modal .modal-content {
            width: 85%;
            padding: 40px 20px;
        }

        .loading-modal h2 {
            font-size: 20px;
            margin-top: 30px;
        }

        .spinner {
            width: 60px;
            height: 60px;
        }
    }

    @media (max-width: 480px) {
        .loading-modal h2 {
            font-size: 18px;
        }
    }
</style>


<style>
    /* CSS for Upload Progress Modal */
    .upload-progress-modal {
        display: none;
        position: fixed;
        bottom: 70px;
        right: 30px;
        /* Position at right */
        width: auto;
        /* Let content determine width */
        max-width: 400px;
        /* Maximum width */
        background: none;
        /* Remove background overlay */
        z-index: 1000;
        pointer-events: auto;
        /* Allow interactions with the modal */
    }

    .upload-modal-content {
        background-color: white;
        color: white;
        border-radius: 12px;
        width: 100%;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        /* Add shadow for better visibility */
    }

    .upload-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* margin-bottom: 20px; */
        background-color: black;
        padding: 5px 15px;
        border-radius: 10px 10px 0 0;
    }

    .upload-header h2 {
        font-size: 12px;
        font-weight: 300;
        margin: 0;
    }

    .close-upload-modal {
        background: none;
        border: none;
        color: white;
        font-size: 24px;
        cursor: pointer;
        padding: 0;
    }

    .file-list {
        padding: 0px 16px 0px 0px;
        /* margin: 20px 0; */
        color: #303030;
    }

    .file-item {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        background: white;
        padding: 10px 15px;
        border-radius: 4px;
    }

    .file-icon {
        width: 24px;
        flex-shrink: 0;
        filter: invert(29%) sepia(0%) saturate(0%) hue-rotate(212deg) brightness(96%) contrast(92%);
        /* This makes the icon #4a4a4a */
    }

    .file-details {
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .file-name {
        word-break: break-all;

        font-size: 12px;
        margin: 0;
        font-weight: 400;
        color: black;
    }

    .file-size {
        color: #888;
        font-size: 14px;
        white-space: nowrap;
        flex-shrink: 0;
        /* Prevents size from wrapping */
    }

    .file-status {
        width: 24px;
        flex-shrink: 0;
        /* Prevents the checkmark from shrinking */
    }

    @media (max-width: 480px) {
        .upload-modal-content {
            width: 95%;
            padding: 15px;
        }

        .upload-header h2 {
            font-size: 20px;
        }

        .file-name {
            font-size: 14px;
            max-width: 150px;
        }

        .file-details {
            max-width: calc(100% - 60px);
        }
    }




    /* CSS styles for the loading animation */
    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .loading-status {
        width: 24px;
        height: 24px;
        border: 2px solid #e0e0e0;
        border-top: 2px solid #3498db;
        border-radius: 50%;
        animation: rotate 1s linear infinite;
        flex-shrink: 0;
    }

    .success-status {
        flex-shrink: 0;
        width: 24px;
        height: 24px;
        background-color: #20a74e;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    /* Adding animation for modal appearance */
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .upload-progress-modal.show {
        display: block;
        animation: slideIn 0.3s ease-out;
    }
</style>


<style>
    /* CSS for Notification Container */

    .notification-container {
        position: fixed;
        top: 80px;
        right: 20px;
        z-index: 9999;
        max-width: 300px;
        width: 100%;

        display: none;
    }

    .notification {
        padding: 7px;
        /* padding: 12px 20px; */
        border-radius: 4px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 10px;
    }

    .notification-text {
        color: #333;
        font-size: 14px;
    }

    .notification.error {
        background-color: #ffd2d2;
        border: 2px solid #ee8585;
        /* border: 2px solid #ffcdd2; */
    }

    /* .notification.error .notification-text {
    color: #d32f2f;
    } */

    .notification.success {
        background-color: #e5f8f6;
        border: 2px solid #a7e8e0;
    }

    .notification-close {
        background: none;
        border: none;
        /* color: #666; */
        position: relative;
        top: -2px;
        font-size: 25px;
        cursor: pointer;
        padding: 0;
        margin-left: 10px;
        line-height: 1;
        float: inline-end;
        font-weight: 300;
    }

    .notification.hide {
        opacity: 0;
    }

    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }

        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    @media (max-width: 768px) {
        .notification-container {
            top: 60px;
            right: 10px;
            left: 10px;
            max-width: none;
        }

        .notification {
            padding: 10px 15px;
        }
    }
</style>

<style>
    .bankstatement .full-cont {
        width: 76%;
    }

    @media (max-width: 576px) {
        .bankstatement .full-cont {
            width: 100% !important;
        }
    }

    @media (max-width: 768px) {
        .bankstatement .full-cont {
            width: 85%;
        }
    }

    .disabled-div {
        pointer-events: none;
        /* Disables all interactions */
        opacity: 0.8;
        /* Makes the div look faded */
        filter: grayscale(20%);
        /* Optional: makes the div look inactive */
    }

    .disabled-div-row {

        opacity: 0.8;
        /* Makes the div look faded */
        filter: grayscale(20%);
        /* Optional: makes the div look inactive */
    }
</style>

@include('frontend.header_auth')



<div class="wrapper">
    <div class="content">

        <div class="notification-container" style="display: none;">
            <div class="notification success">
                <span class="notification-text">Your Bank Statement Analysis is ready.</span>
                <button class="notification-close">&times;</button>
            </div>
        </div>

        <div class="bankstatement">
            <div class="dynamic">
                <center>
                    <p> Name: {{ Auth::user()->name}} &nbsp;&nbsp;&nbsp; Mobile No: +91 {{ Auth::user()->mobile}}</p>
                </center>
            </div>
            <div class="container container12 full-cont">
                <h1>Bank Statement Analysis</h1>
                <center>
                    <div class="step {{ $runAnalysisStatus ? 'disabled-div' : '' }}" style="width: 80%;" id="run_step1">
                        <div class="step-header">
                            <span class="step-number">1</span>
                            <span class="step-title">Upload Bank Statements</span>
                        </div>
                        <p class="step-description">Upload original files from your net banking portal. Scanned files/images will be rejected.</p>
                        <div style="overflow-x: auto; width: 100%;">
                            <table class="upload-table">
                                <thead class="thead-hide">
                                    <tr>
                                        <th style="border-bottom: 2px solid #ddd;" colspan="5">Bank Statement</th>
                                    </tr>
                                </thead>
                                <thead class="thead-hide">
                                    <tr>
                                        <th>BANK_STATEMENT</th>
                                        <th>
                                            <center>PDF</center>
                                        </th>
                                        <th>
                                            <center>10mb</center>
                                        </th>
                                        <th style="float: inline-end;"><label id="add-file-btn" class="upload-btn">
                                                <i class="fa-solid fa-cloud-arrow-up"></i> <span class="upload-text">Upload</span>
                                            </label>
                                            <input type="file" id="file-input" class="add-file-input" style="display:none;" multiple>
                                        </th>
                                    </tr>
                                </thead>
                                <thead class="thead-show" style="display: none;">
                                    <tr>
                                        <th style="border-bottom: 2px solid #ddd;">Name</th>
                                        <th style="border-bottom: 2px solid #ddd;">
                                            File Name
                                        </th>
                                        <th style="border-bottom: 2px solid #ddd;">
                                            <center>Format</center>
                                        </th>
                                        <th style="border-bottom: 2px solid #ddd;">
                                            <center>Max Size</center>
                                        </th>
                                        <!-- <th style="border-bottom: 2px solid #ddd;">
                                        <i class="fa-solid fa-plus-circle" id="select-other-img" style="float: inline-end; color: white; background: #c71c8e; padding: 3px; border-radius: 50%; font-size: x-large; cursor: pointer;"></i>
                                        
                                    </th> -->
                                        <th style="border-bottom: 2px solid #ddd; padding-right: 7px;">
                                            <label id="select-other-img" class="upload-btn" style="float: inline-end; padding: 6px 5px; font-size: 10px;">
                                                <i class="fa-solid fa-cloud-arrow-up" style="font-size: 13px;"></i> <span class="upload-text">Upload</span>
                                            </label>

                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="file-rows">
                                    <!-- Dynamic Rows Will Be Appended Here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </center>

                <center>
                    <div class="step2 clearfix {{ $runAnalysisStatus ? 'disabled-div' : '' }}" style="width: 80%;" id="run_step2">
                        <div class="step-header" style=" margin-bottom: 15px;">
                            <span class="step-number">2</span>
                            <span class="step-title">Run Bank Statement Analysis</span>
                        </div>
                        <button class="action-btn" id="run-analysis" onclick="showModal()" disabled>Run Analysis</button>
                    </div>
                </center>

                <center>
                    <div class="step3 clearfix" style="width: 80%;" id="run_step3">
                        <div class="step-header" style=" margin-bottom: 15px;">
                            <span class="step-number">3</span>
                            <span class="step-title">Download Output</span>
                        </div>
                        <button class="action-btn" id="download-output" disabled>Download Excel</button>
                    </div>
                </center>

            </div>
        </div>

        <!-- Modal for upload statements of another bank account -->
        <div class="custom-modal" id="uploadMoreModal">
            <div class="modal-content" style="max-width: 450px; background-color: #fff; border-radius: 20px;">
                <h2>Do you want to upload more statements of another bank account?</h2>
                <div class="modal-buttons">
                    <button class="modal-btn no-btn">No</button>
                    <button class="modal-btn yes-btn">Yes</button>
                </div>
            </div>
        </div>


        <!-- Loading Modal -->
        <div class="loading-modal" id="loadingModal">
            <div class="modal-content">
                <div class="spinner"></div>
                <h2>Analysis in process, you can wait here or download output from the SMS notification.</h2>
            </div>
        </div>


        <!-- Upload Progress Modal -->
        <div class="upload-progress-modal" id="uploadProgressModal">
            <div class="upload-modal-content">
                <div class="upload-header">
                    <h2>Uploading <span id="fileCount">0</span> Files</h2>
                    <button class="close-upload-modal" onclick="hideUploadModal()">×</button>
                </div>
                <div class="file-list" id="uploadFileList">
                    <!-- File items will be added here dynamically -->
                </div>
            </div>
        </div>
    </div>


    <div class="footer">
        @include('frontend.footer')
    </div>
</div>
</body>


<script>
    const fileRows = document.getElementById('file-rows');
    const fileInput = document.getElementById('file-input');
    const runAnalysisButton = document.getElementById('run-analysis');
    const downloadOutputButton = document.getElementById('download-output');
    const uploadModal = document.getElementById('uploadProgressModal');
    const fileListContainer = document.getElementById('uploadFileList');
    const fileCountSpan = document.getElementById('fileCount');
    let uploadCount = 0;
    const run_step1 = document.getElementById('run_step1');
    const run_step2 = document.getElementById('run_step2');
    const run_step3 = document.getElementById('run_step3');

    document.getElementById('add-file-btn').addEventListener('click', () => fileInput.click());

    ///U Changes Start

    document.getElementById('select-other-img').addEventListener('click', () => {
        fileInput.click();
    });

    function showUploadModal() {
        uploadModal.style.display = 'flex';
    }

    function hideUploadModal() {
        uploadModal.style.display = 'none';
        uploadCount = 0;
        fileListContainer.innerHTML = '';
    }


    function addFileToUploadModal(file) {
        uploadCount++;
        fileCountSpan.textContent = uploadCount;

        const fileItem = document.createElement('div');
        fileItem.className = 'file-item';
        fileItem.innerHTML = `
        <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='black'%3E%3Cpath d='M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z'/%3E%3C/svg%3E" class="file-icon">
        <div class="file-details">
            <div class="file-name">${file.name}</div>&nbsp;
            <div class="file-size">${(file.size / 1024).toFixed(0)}KB</div>
        </div>
        <div class="loading-status"></div>
    `;

        fileListContainer.appendChild(fileItem);

        // Simulate upload completion after random time (1-2 seconds)
        setTimeout(() => {
            const loadingStatus = fileItem.querySelector('.loading-status');
            loadingStatus.outerHTML = `
            <div class="success-status">
                <img src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'%3E%3Cpath d='M9.707 14.293l-2.293-2.293-1.414 1.414L9.707 17.121 16.414 10.414 15 9l-5.293 5.293z'/%3E%3C/svg%3E">
            </div>
        `;
        }, Math.random() * 1000 + 1000);
    }

    // Add this function to check if any file is over 10MB
    function checkFileSizes() {
        const rows = fileRows.getElementsByTagName('tr');
        for (let row of rows) {
            const sizeCell = row.querySelector('td[data-label="Max Size"]');
            if (sizeCell) {
                const size = parseFloat(sizeCell.textContent.split(' ')[0]);
                if (size > 10) {
                    return false; // Found a file larger than 10MB
                }
            }
        }
        return true; // All files are under 10MB
    }


    ///U Changes End




    // Fetch and display saved data from the server
    const fetchSavedData = async () => {

        try {
            const response = await fetch('/customer/get-documents');
            const data = await response.json();

            // Clear existing rows to prevent duplication
            fileRows.innerHTML = '';

            if (data.success) {
                data.documents.forEach(doc => addFileRow(doc));
            } else {
                console.error("Error fetching documents:", data.error);
            }
        } catch (error) {
            console.error("Error fetching saved documents:", error);
        }
    };

    // Add a new file row to the table
    const addFileRow = (fileData) => {
        $('.thead-hide').hide();
        $('.thead-show').show();
        const {
            document_id,
            file_name,
            max_size,
            bank_name,
            file_pwd,
            status,
            unique_file_name,
            upload_status,
            password_protected
        } = fileData;

        // Main row for file details
        const row = document.createElement('tr');
        row.setAttribute('data-unique-file-name', unique_file_name); // Store unique_file_name as an attribute
        row.setAttribute('data-document-id', document_id); // Store document_id as an attribute
        row.innerHTML = `
            <td data-label="Name">BANK_STATEMENT</td>
            <td data-label="File Name"><input type="text" class="hidden" hidden value="${file_name}" readonly>
            <label style="font-size: 12px; font-weight: 400; word-break: break-all;">${file_name}</label>
            </td>
            <td data-label="Format">${file_name.split('.').pop().toUpperCase()}</td>
            <td data-label="Max Size">${max_size}</td>
            <td data-label="Actions">
                <i class="fa-solid fa-trash" style=""></i>
            </td>
        `;
        fileRows.appendChild(row);

        // Secondary row for additional details
        const nextRow = document.createElement('tr');
        nextRow.setAttribute('data-unique-file-name', unique_file_name); // Store unique_file_name as an attribute
        nextRow.setAttribute('data-document-id', document_id); // Store document_id as an attribute
        nextRow.innerHTML = `
            <td class="tusing" data-label="Bank" colspan="5" style="background-color: #eff0f3;">
         <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
        <input type="checkbox" class="checkbox-input" ${upload_status==='s3' ? '' : 'disabled' } id="fileStatus" name="file_status" style="accent-color: #20a74e; max-width: 30px;">
        </label>
        <select>
            <option value="" selected hidden>Select Bank</option>
            <option value="HDFC" ${bank_name==='HDFC' ? 'selected' : '' }>HDFC Bank</option>
            <option value="ICICI" ${bank_name==='ICICI' ? 'selected' : '' }>ICICI Bank</option>
            <option value="PNB" ${bank_name==='PNB' ? 'selected' : '' }>PNB Bank</option>
        </select>

        <select class="password-select">
            <option value="" selected hidden>Is File Password protected?</option>
            <option value="No" ${password_protected === 'No' ? 'selected' : '' }>No</option>
            <option value="Yes" ${password_protected === 'Yes' ? 'selected' : '' }>Yes</option>
        </select>

        <input type="password" value="${file_pwd || ''}" ${!file_pwd ? 'readonly' : '' }>
        ${file_pwd ? '<i class="fa-solid fa-eye toggle-password" style="cursor: pointer; display: inline-block; position: absolute; right: 10px; top: 8px;"></i>' : ''}

        <button class="save-btn" ${upload_status==='s3' ? '' : '' } style="background-color: #273896;">Save</button>
    </div>
</td>
        `;
        fileRows.appendChild(nextRow);

        if (fileRows.childElementCount > 0) {
            runAnalysisButton.disabled = false; // Enable if count is greater than 0
            downloadOutputButton.disabled = true;
        } else {
            runAnalysisButton.disabled = true; // Disable if count is 0
            downloadOutputButton.disabled = true;
        }
        //runAnalysisButton.disabled = !checkFileSizes();
        // Attach delete functionality
        const deleteBtn = row.querySelector('.fa-trash');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', () => deleteRow(document_id, unique_file_name, row, nextRow));
        }

        // Password select toggle functionality
        const passwordSelect = nextRow.querySelector('.password-select');
        const passwordInput = nextRow.querySelector('input[type="password"]');
        const togglePasswordBtn = nextRow.querySelector('.toggle-password');

        passwordSelect.addEventListener('change', () => {
            if (passwordSelect.value === 'Yes') {
                passwordInput.removeAttribute('readonly');
                if (togglePasswordBtn) {
                    togglePasswordBtn.style.display = 'inline-block';
                }
            } else {
                passwordInput.setAttribute('readonly', true);
                passwordInput.value = ''; // Clear password field if "No" is selected
                if (togglePasswordBtn) {
                    togglePasswordBtn.style.display = 'none';
                }
            }
        });

        // Password visibility toggle
        if (togglePasswordBtn) {
            togglePasswordBtn.addEventListener('click', () => {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
            });
        }

        // Save button functionality
        const saveBtn = nextRow.querySelector('.save-btn');
        saveBtn.addEventListener('click', () => {
            const bankSelect = nextRow.querySelector('select').value;
            const password = passwordInput.value;
            const passwordProtected = passwordSelect.value;

            if (!bankSelect) {
                alert("Please select a bank.");
                return;
            }

            updateDocument(document_id, unique_file_name, bankSelect, passwordProtected, password, saveBtn, row, nextRow);
        });
    };

    // Update document details via API
    const updateDocument = async (documentId, uniqueFileName, bankName, passwordProtected, password, saveBtn, row, nextRow) => {
        try {
            const response = await fetch('/customer/save-document', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    document_id: documentId,
                    unique_file_name: uniqueFileName,
                    bank_name: bankName,
                    password_protected: passwordProtected,
                    password,
                    status: 'S3',
                }),
            });

            const data = await response.json();
            if (data.success) {
                alert("Document updated successfully!");
                nextRow.querySelector('.checkbox-input').removeAttribute('disabled');
                row.classList.add('disabled-div-row');
                nextRow.classList.add('disabled-div-row');


                // let document_id = data.document_id; // Replace with the dynamic document ID you want to target

                // // Use template literals to dynamically insert the document_id value into the selector
                
                // let row_one = document.querySelector(`[data-document-id1="${document_id}"]`);

                // // Find the checkbox inside this row
                // let checkbox = row_one.querySelector('.checkbox-input');

                // // Remove the 'disabled' attribute from the checkbox
                // if (checkbox) {
                //     checkbox.removeAttribute('disabled');
                // }
                //saveBtn.setAttribute('disabled', true);
                //row.querySelector('.fa-trash').style.display = 'none';

                // Disable the password input field if not password protected
                //row.querySelector('.password-select').setAttribute('disabled', true);
                //row.querySelector('input[type="password"]').setAttribute('readonly', true);

                // Enable the checkbox after successful save


            } else {
                alert(`Error updating document: ${data.error}`);
            }
        } catch (error) {
            console.error("Error updating document:", error);
        }
    };

    // Delete row and update document status via API
    const deleteRow = async (documentId, uniqueFileName, row, nextRow) => {
        try {
            const response = await fetch('/customer/delete-document', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    document_id: documentId,
                    unique_file_name: uniqueFileName
                }),
            });

            const data = await response.json();
            if (data.success) {
                row.remove();
                nextRow.remove();
                if (fileRows.childElementCount > 0) {
                    runAnalysisButton.disabled = false; // Enable if count is greater than 0
                    downloadOutputButton.disabled = true;
                } else {
                    runAnalysisButton.disabled = true; // Disable if count is 0
                    downloadOutputButton.disabled = true;
                }
                // runAnalysisButton.disabled = !checkFileSizes();
            } else {
                alert(`Error deleting document: ${data.error}`);
            }
        } catch (error) {
            console.error("Error deleting document:", error);
            // runAnalysisButton.disabled = !checkFileSizes();
        }
    };

    // Handle file uploads
    fileInput.addEventListener('change', () => {
        showUploadModal();
        [...fileInput.files].forEach(file => {

            addFileToUploadModal(file);
            const uniqueFileName = `${Date.now()}_${file.name}`;
            const maxFileSize = (file.size / (1024 * 1024)).toFixed(2);
            $('.thead-hide').hide();
            $('.thead-show').show();
            const formData = new FormData();
            formData.append('file', file);
            formData.append('file_name', file.name);
            formData.append('unique_file_name', uniqueFileName);
            formData.append('max_size', maxFileSize);
            formData.append('status', 'local');

            fetch('/customer/upload-document', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                })
                .then(() => fetchSavedData())
                .catch(error => console.error("Error uploading file:", error));
        });
    });

    // Initial load of saved data
    fetchSavedData();
</script>



<script>
    //const runAnalysisButton = document.getElementById('run-analysis');
    async function runAnalysis() {
        //runAnalysisButton.addEventListener('click', async () => {
        // Get all rows with checkboxes
        const checkboxes = document.querySelectorAll('.checkbox-input:checked');

        // Collect selected document_ids and filenames
        const selectedDocuments = [];
        checkboxes.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const documentId = row.getAttribute('data-document-id'); // Get document_id from the row
            if (documentId) {
                selectedDocuments.push(documentId);
            }
        });

        // Check if there are selected documents
        if (selectedDocuments.length === 0) {
            alert('Please select at least one file to analyze.');
            return;
        }

        try {
            // Make API call to run analysis
            const response = await fetch('/customer/run-analysis', {
                method: 'POST',
                body: JSON.stringify({
                    document_ids: selectedDocuments
                }),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            });

            const data = await response.json();

            if (data.success) {
                runAnalysisButton.disabled = true;
                run_step1.classList.add('disabled-div');
                run_step2.classList.add('disabled-div');
                hideLoadingModal();
                //alert('Analysis started successfully! Check the analysis results later.');
                // Optionally, update the UI or redirect
            } else {
                alert('Error: ' + data.error);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('There was an error starting the analysis.');
        }
    }
    //});
</script>


<script>
    downloadOutputButton.addEventListener('click', async () => {

        //window.location.href = '/download-report-get';
        //document.getElementById('download-output').addEventListener('click', async () => {
        try {
            // Call the backend to get the report URL
            const response = await fetch('/customer/download-report', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    document_id: 1
                }), // Replace USER_ID dynamically
            });

            const data = await response.json();

            if (data.success && data.file_url) {
                // Redirect to download file
                const fileLink = document.createElement('a');
                fileLink.href = data.file_url;
                fileLink.download = ''; // Let the browser use the filename from the response
                document.body.appendChild(fileLink);
                fileLink.click();
                document.body.removeChild(fileLink);
            } else {
                alert(data.error || 'Failed to download the file.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while downloading the file.');
        }
    });
</script>


<script>
    // Script for modal for upload statements of another bank account
    const modal = document.getElementById('uploadMoreModal');

    // Show modal
    function showModal() {
        modal.style.display = 'flex';
    }
    // showModal();

    // Hide modal
    function hideModal() {
        modal.style.display = 'none';
    }

    // Event listeners for buttons
    document.querySelector('.yes-btn').addEventListener('click', hideModal);
    document.querySelector('.no-btn').addEventListener('click', () => {

        hideModal();
        showLoadingModal();
        runAnalysis();
        //runAnalysisButton.click();
    });

    // Close modal if clicking outside
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            hideModal();
        }
    });
</script>


<script>
    // Loading Modal Control
    const loadingModal = document.getElementById('loadingModal');

    function showLoadingModal() {
        const loadingModal = document.getElementById('loadingModal');
        loadingModal.style.display = 'flex';

        // Simulate process completion after 5 seconds
        // setTimeout(hideLoadingModal, 5000);
    }

    function hideLoadingModal() {
        const loadingModal = document.getElementById('loadingModal');
        loadingModal.style.display = 'none';


        downloadOutputButton.disabled = false;

        // Show notification immediately after hiding loading modal
        showNotification();

    }
</script>


<script>
    // Script for showing notification message 
    function showNotification() {
        const notificationContainer = document.querySelector('.notification-container');
        notificationContainer.style.display = 'block';

        // Auto hide after 5 seconds
        setTimeout(() => {
            hideNotification();
        }, 5000);
    }

    function hideNotification() {
        const notificationContainer = document.querySelector('.notification-container');
        const notification = document.querySelector('.notification');

        notification.classList.add('hide');
        setTimeout(() => {
            notificationContainer.style.display = 'none';
            notification.classList.remove('hide');
        }, 300);
    }

    // Add click handler for notification close button
    document.querySelector('.notification-close').addEventListener('click', () => {
        hideNotification();
    });
</script>