<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
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
        font-size: 10px;
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
        display: flex;
        align-items: center;
        gap: 8px;
        /* padding: 10px 15px; */
        padding: 8px 16px;
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
        margin: auto 0;
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
        /* border: 1px solid #ddd; */
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
        font-family: Avenir LT Std;
        font-size: 12px;
        font-weight: 400;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .upload-table td .save-btn {
        color: white;
        width: 100% !important;
        padding: 7px 0 !important;
        text-align: center !important;
        min-width: 80px !important;
        box-sizing: border-box !important;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    /* .upload-table td .save-btn:hover {
        background-color: #218838;
    } */

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

        /* .upload-table th:nth-child(1),
        .upload-table th:nth-child(2),
        .upload-table th:nth-child(3),
        .upload-table th:nth-child(4) {
        display: none;
        } */

        .action-cell-del {
            float: none !important;
            height: 65px;
        }

        .hide-th-extra {
            display: none !important;
        }

        .inc-height-upl {
            height: 45px !important;
        }

        /* .make-center {
            text-align: left !important;
        } */

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
            white-space: normal;
            /* Allow text to wrap */
            max-width: 40%;
            /* Limit width to prevent overflow */
            word-wrap: break-word;
            /* Break long words */
            line-height: 1.2;
            /* Adjust line height for better readability */
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

    @media (max-width: 375px) {
        .dynamic {
            margin-top: 10px;
        }
    }

    @media (max-width: 480px) {
        .step {
            width: 90% !important;
            padding: 10px 0;
        }

        .step2 {
            width: 90% !important;
            padding: 10px 0;
        }

        .step3 {
            width: 90% !important;
            padding: 10px 0;
        }

        .step-description {
            margin-left: 0 !important;
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
    /* .loading-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 1000;
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
        text-transform: none;
    }

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

    @keyframes  spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

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
    } */
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
        justify-content: center;
        align-items: center;
    }

    .loading-modal .modal-content {
        background-color: white;
        padding: 40px 10px;
        border-radius: 12px;
        width: 90%;
        max-width: 450px;
        text-align: center;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .loading-modal .modal-text {
        display: flex;
        flex-direction: column;
        /* gap: 10px; */
    }

    .loading-modal h2 {
        font-size: 16px;
        color: #000;
        font-weight: 400;
        line-height: 1.5;
        margin: 0;
    }

    .loading-modal p {
        font-size: 16px;
        color: #000;
        width: 361px;
        font-weight: 400;
        line-height: 1.5;
        margin: 0 auto;
    }

    .loading-modal .ok-button {
        background-color: #273896;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        align-self: center;
        min-width: 90px;
        transition: background-color 0.3s ease;
    }

    .loading-modal .ok-button:hover {
        background-color: #1e2b75;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .loading-modal .modal-content {
            width: 85%;
            padding: 30px;
            margin: 20px;
        }

        .loading-modal h2,
        .loading-modal p {
            font-size: 14px;
        }

        .loading-modal .ok-button {
            padding: 10px 30px;
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .loading-modal .modal-content {
            padding: 25px;
        }

        .loading-modal h2,
        .loading-modal p {
            font-size: 13px;
        }
    }

    .loading-modal .modal-content {
        position: relative;
        /* Add this to position the close button */
    }

    .loading-modal .close-modal {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 24px;
        color: #0f0f0f;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .loading-modal .close-modal:hover {
        background-color: #f0f0f0;
        color: #333;
    }

    /* Update padding-top of modal content to accommodate close button */
    .loading-modal .modal-text {
        padding-top: 10px;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .loading-modal .close-modal {
            top: 10px;
            right: 10px;
            font-size: 22px;
        }
    }

    @media (max-width: 480px) {
        .loading-modal .close-modal {
            font-size: 20px;
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
    @keyframes  rotate {
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
    @keyframes  slideIn {
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

    @keyframes  slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes  slideOut {
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
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }

    /* @media (max-width: 768px) {
        .bankstatement .full-cont {
            width: 85%;
        }
    } */

    .disabled-div {
        pointer-events: none;
        /* Disables all interactions */
        opacity: 0.8;
        /* Makes the div look faded */
        filter: grayscale(20%);
        /* Optional: makes the div look inactive */
    }

    .disabled-div-row {

        opacity: 0.8 !important;
        /* Makes the div look faded */
        filter: grayscale(20%);
        /* Optional: makes the div look inactive */
    }
</style>

<style>
    .step-header-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        width: 100%;
        margin-bottom: 20px;
    }

    .step-header-left {
        flex: 1;
    }

    .step-header-right {
        padding-top: 8px;
    }

    /* .upload-button {
        background-color: #E91E63;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 8px 16px;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 14px;
        transition: background-color 0.3s ease;
    } */

    /* .upload-button:hover {
        background-color: #D81B60;
    } */

    /* .upload-button i {
        font-size: 16px;
    } */

    /* Responsive styles */
    @media (max-width: 768px) {
        .step-header-container {
            flex-direction: column;
            align-items: flex-start;
        }

        .step-header-right {
            width: 100%;
            /* margin-top: 15px; */
            padding-top: 0;
        }

        .upload-btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .step-header-container {
            margin-bottom: 15px;
        }

        .upload-btn {
            font-size: 13px;
            padding: 6px 12px;
        }
    }
</style>

<style>
    /* Card Style */
    .file-card {
        background: white;
        border-radius: 8px;
        /* border: 1px solid #ddd; */
        /* padding: 20px; */
        /* margin-bottom: 15px; */
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    /* Header Row */
    .file-header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        /* margin-bottom: 15px; */
    }

    .file-header-left {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .checkbox-wrapper {
        display: flex;
        align-items: center;
    }

    .checkbox-input {
        width: 20px;
        height: 20px;
        accent-color: #20a74e;
    }

    .file-info {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        /* margin-bottom: 10px; */
    }

    .file-info-label {
        color: #778294;
        font-size: 10px;
    }

    .file-info-value {
        color: #333;
        font-size: 14px;
        font-weight: 700;
    }

    /* Form Controls Row */
    .file-controls {
        display: grid;
        grid-template-columns: 2fr 2fr 2fr 1fr;
        gap: 15px;
        align-items: center;
    }

    .form-select,
    .form-input {
        width: 100% !important;
        padding: 6px !important;
        border: 1px solid #bcbcbe !important;
        border-radius: 6px !important;
        /* background: #edeef0 !important; */
        font-size: 12px;
    }

    .form-select {
        appearance: none !important;
        -webkit-appearance: none !important;
        -moz-appearance: none !important;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3E%3Cpath fill='%23666' d='M8 10.5l-4-4h8l-4 4z'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 8px center !important;
        background-size: 16px !important;
        cursor: pointer !important;
        font-size: 12px !important;
        color: #333;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
        padding-right: 30px !important;
    }

    .edit-btn,
    .save-btn {
        background: #273896;
        color: white;
        border: none;
        padding-top: 6px;
        padding-bottom: 6px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 12px;
    }

    .delete-btn {
        color: #ff4444;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 18px;
    }

    /* Responsive Design */
    @media (max-width: 875px) {
        .file-info {
            grid-template-columns: repeat(2, 1fr);
        }

        .chq-bx {
            position: unset !important;
        }

        .file-controls {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .edit-btn,
        .save-btn {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .file-info {
            grid-template-columns: 1fr;
        }

        .file-header {
            /* flex-direction: column; */
            /* justify-content: center; */
            align-items: baseline;
            gap: 10px;
        }
    }
</style>

<style>
    .upload-table thead {
        border-bottom: 1px solid #dee2e6;
        /* Light gray border at bottom */
    }

    @media (max-width: 768px) {
        .upload-table thead {
            border-bottom: none;
            /* Light gray border at bottom */
        }

        .action-cell-del {
            border-left: 1px solid #ddd !important;
            border-radius: 8px !important;
        }
    }

    .upload-table thead tr:first-child {
        border-bottom: 1px solid #dee2e6;
    }

    @media (max-width: 768px) {
        .upload-table thead tr:first-child {
            border-bottom: none !important;
        }
    }

    .upload-table thead th {
        padding: 12px 15px;
        color: #333;
        font-weight: 400;
        /* border-bottom: 1px solid #dee2e6; */
    }

    /* For the outer border of the entire table */
    .upload-table {
        /* border: 1px solid #dee2e6; */
        border-radius: 8px;
    }


    @media (max-width: 768px) {
        .checkbox-wrapper {
            bottom: -4px !important;
        }

        .second-text1 {
            width: unset !important;
        }
    }
</style>

<style>
    .upload-table {
        position: relative;
        /* Ensure the table is positioned relative */
        overflow: visible;
        /* Allow dropdown to be visible outside the table */
        border-radius: 8px;
        /* Keep your existing styles */
    }

    .custom-dropdown {
        position: relative;
        /* Ensure the dropdown is positioned relative to its container */
        width: auto;
        font-family: Avenir LT Std;
        /* Adjust width as needed */
    }

    .selected-option {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3E%3Cpath fill='%23666' d='M8 10.5l-4-4h8l-4 4z'/%3E%3C/svg%3E") !important;
        background-repeat: no-repeat !important;
        background-position: right 8px center !important;
        background-size: 16px !important;
        border-radius: 6px;
        padding: 8px;
        border: 1px solid #ccc;
        cursor: pointer;
        background: white;
        /* Ensure background is white to cover underlying content */
        z-index: 1;
        /* Set z-index to ensure it is above other elements */
    }

    .dropdown-options {
        display: none;
        /* Hidden by default */
        position: absolute;
        /* Position it absolutely to the parent */
        background: white;
        /* Background color for the dropdown */
        border: 1px solid #ccc;
        width: 100%;
        z-index: 1000;
        border-radius: 0 0 8px 8px;
        max-height: 200px;
        /* Set a max height for the dropdown */
        overflow-y: auto;
        /* Enable vertical scrolling */
        overflow-x: width 0.3s ease;
    }

    @media (max-width: 425px) {
        .dropdown-options {
            width: 100% !important;
            /* Set a fixed width for mobile view */
            min-width: auto !important;
            /* Remove minimum width to allow full width */
        }
    }

    .dropdown-option:focus {
        min-width: 150px;
        width: auto;
    }

    .bank-search {
        width: 100%;
        /* Full width */
        padding: 5px;
        /* Padding for the search input */
        border: 1px solid #ccc;
        /* Border for the search input */
        border-radius: 4px;
        /* Rounded corners */
        margin-bottom: 5px;
        /* Space between search input and options */
        box-sizing: border-box;
        /* Ensure padding is included in width */
        transition: width 0.3s ease;
        min-width: 150px;
    }

    .dropdown-option {
        padding: 5px 10px;
        padding-right: 0px;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .dropdown-option:hover {
        background-color: #f0f0f0;
    }

    .bank-logo {
        width: 20px;
        /* Adjust size as needed */
        height: 20px;
        /* Adjust size as needed */
        margin-right: 8px;
        /* Space between image and text */
    }
</style>

<style>
    .bank-item {
        display: flex;
        /* Use flexbox for alignment */
        justify-content: space-between;
        /* Space between bank name and logo container */
        align-items: center;
        /* Center items vertically */
        width: 100%;
        /* Full width */
    }

    .bank-name {
        flex: 1;
        /* Allow the bank name to take available space */
        margin-right: 10px;
        /* Space between name and logo container */
        white-space: nowrap;
        /* Prevent the bank name from wrapping */
        overflow: hidden;
        /* Hide overflow */
        text-overflow: ellipsis;
        /* Show ellipsis for overflow text */
    }

    .bank-logo-container {
        display: flex;
        /* Use flexbox for alignment */
        align-items: center;
        /* Center items vertically */
        justify-content: flex-end;
        /* Align items to the right */
    }

    .only-on-text {
        font-size: 7px;
        margin-right: 1px;
        color: #5e5e5e;
        /* Adjust color as needed */
    }

    .bank-logo {
        width: 20px;
        /* Adjust size as needed */
        height: 20px;
        /* Adjust size as needed */
        flex-shrink: 0;
        /* Prevent logo from shrinking */
    }
</style>


<style>
    /* Mobile view changes and scroll to top button changes */
    @media (max-width: 426px) {
        .file_details_mob {
            display: inline-flex;
        }

        .colon-text {
            display: contents !important;
        }

        .file-info-value {
            margin-left: 5px;
            font-family: Avenir LT Std;
            color: #000000;
            font-size: 11px;
            font-weight: 350;
            letter-spacing: 0.5px;
        }

        .file-info-label {
            font-family: Avenir LT Std;
            color: #000000;
            font-size: 11px;
            font-weight: 350;
            letter-spacing: 0.5px;
        }

        .chq-bx {
            height: 20px !important;
            width: 17px !important;
            /* margin-left: -15px !important; */
        }

        .file-info {
            margin-left: 10px;
        }

        .secondary-upload {
            width: unset !important;
            float: inline-start !important;
            margin-left: 40px !important;
            gap: 5px !important;
        }

        .secondary-upload i {
            margin-right: 0;
        }

        .step-header {
            flex-direction: unset;
        }

        .step-number {
            width: 25px;
            height: 25px;
            font-size: 14px;
            margin-bottom: unset;
            margin-left: 5px;
        }

        .action-btn {
            width: 30%;
            margin-left: 37px;
        }

        .step-description {
            margin-top: 5px;
            text-align: left;
            line-height: unset;
            margin-left: 41px !important;
        }
    }


    .scroll-to-top {
        position: fixed;
        bottom: 30px;
        right: 17px;
        background-color: #F5F7FA;
        color: black;
        border: none;
        border-radius: 50%;
        width: 35px;
        box-shadow: 0 0 15px 5px rgba(0, 0, 0, 0.3);
        height: 35px;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 1000;
        /* Ensure it appears above other elements */
        transition: opacity 0.3s ease, background-color 0.3s ease;
        /* Smooth transition */
    }

    /* .scroll-to-top:hover {
        background-color: rgba(39, 56, 150, 1);
    } */

    @media (min-width: 426px) {
        .scroll-to-top {
            display: none !important;
            /* Hide button on larger screens */
        }
    }
</style>


<?php echo $__env->make('frontend.header_auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<button id="scrollToTopBtn" class="scroll-to-top" style="display: none;">↑</button>

<div class="wrapper">
    <div class="content">



        <div class="notification-container">
            <div class="notification " id="notification" style="display: none;">
                <span class="notification-text" id="notification-text">Your Bank Statement Analysis is ready.</span>
                <button class="notification-close">&times;</button>
            </div>
        </div>

        <div class="bankstatement">
            <div class="dynamic">
                <center>
                    <p> Name: <?php echo e(Auth::user()->name); ?> &nbsp;&nbsp;&nbsp; Mobile No: +91 <?php echo e(Auth::user()->mobile); ?></p>
                </center>
            </div>
            <div class="container container12 full-cont">
                <h1>Bank Statement Analysis</h1>
                <center>
                    <div class="step <?php echo e($runAnalysisStatus ? 'disabled-div' : ''); ?>" style="width: 80%;" id="run_step1">
                        <!-- <div class="step-header">
                            <span class="step-number">1</span>
                            <span class="step-title">Upload Bank Statements</span>
                        </div>
                        <p class="step-description">Upload original files from your net banking portal. Scanned files/images will be rejected.</p> -->

                        <div class="step-header-container">
                            <div class="step-header-left">
                                <div class="step-header">
                                    <span class="step-number">1</span>
                                    <span class="step-title">Upload Bank Statements</span>
                                </div>
                                <p class="step-description">Upload original files from your net banking portal. Scanned files/images will be rejected.</p>
                            </div>
                            <div class="step-header-right" style="display: none;">
                                <label id="select-other-img" class="upload-btn secondary-upload" style="float: inline-end; padding: 6px 5px; font-size: 14px;">
                                    <i class="fa-solid fa-cloud-arrow-up" style="font-size: 13px;"></i> <span class="upload-text">Upload</span>
                                </label>
                            </div>
                        </div>

                        <table class="upload-table">
                            <thead class="thead-hide">
                                <tr>
                                    <th class="hide-th-extra" style="border: 1px solid #ddd;" colspan="5">
                                        Bank Statement
                                    </th>
                                </tr>
                            </thead>

                            <thead class="thead-hide">
                                <tr>
                                    <th class="hide-th-extra" style="border: 1px solid #ddd;border-right: none;border-radius: 0 0 0 8px;">BANK_STATEMENT</th>
                                    <th class="hide-th-extra" style="border: 1px solid #ddd;border-right: none;border-left: none;">
                                        <center>PDF</center>
                                    </th>
                                    <th class="hide-th-extra" style="border: 1px solid #ddd;border-right: none;border-left: none;">
                                        <center>10mb</center>
                                    </th>
                                    <th class="action-cell-del" style="border: 1px solid #ddd;border-left: none;border-radius: 0 0 8px 0;"><label id="add-file-btn" style="float: inline-end;" class="upload-btn">
                                            <i class="fa-solid fa-cloud-arrow-up"></i> <span class="upload-text">Upload</span>
                                        </label>
                                        <input type="file" id="file-input" class="add-file-input" style="display:none;" multiple>
                                    </th>
                                </tr>
                            </thead>

                            <!-- <thead class="thead-show" style="display: none;">
                                <tr>
                                    <th class="hide-th-extra" style="border-bottom: 2px solid #ddd;">Name</th>
                                    <th class="hide-th-extra" style="border-bottom: 2px solid #ddd;">
                                        File Name
                                    </th>
                                    <th class="hide-th-extra" style="border-bottom: 2px solid #ddd;">
                                        Format
                                    </th>
                                    <th class="hide-th-extra" style="border-bottom: 2px solid #ddd;">
                                        Max Size(10mb)
                                    </th>
                                    <th class="inc-height-upl" style="border-bottom: 2px solid #ddd; padding-right: 7px;">
                                        <label id="select-other-img" class="upload-btn" style="float: inline-end; padding: 6px 5px; font-size: 10px;">
                                            <i class="fa-solid fa-cloud-arrow-up" style="font-size: 13px;"></i> <span class="upload-text">Upload</span>
                                        </label>
                                    </th>
                                </tr>
                            </thead> -->
                            <tbody id="file-rows">
                                <!-- Dynamic Rows Will Be Appended Here -->
                            </tbody>
                        </table>

                    </div>
                </center>

                <center>
                    <div class="step2 clearfix <?php echo e($runAnalysisStatus ? 'disabled-div' : ''); ?>" style="width: 80%;" id="run_step2">
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
                        <button class="action-btn" id="download-output" <?php echo e($runAnalysisStatus ? '' : 'disabled'); ?>>Download Excel</button>
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
                <button class="close-modal" onclick="hideLoadingModal()">&times;</button>
                <div class="modal-text">
                    <h2>Your task is in progress and may take some time.</h2>
                    <p class="second-text1">You'll be notified via SMS with a download link once it's ready.</p>
                </div>
                <button class="ok-button" onclick="hideLoadingModal()">OK</button>
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
        <?php echo $__env->make('frontend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    const runAnalysisStatus = <?php echo json_encode($runAnalysisStatus, 15, 512) ?>;

    // const banks = [{
    //         code: "ICICI",
    //         name: "ICICI Bank",
    //         flag: false
    //     },
    //     {
    //         code: "HDFC",
    //         name: "HDFC Bank",
    //         flag: false
    //     },
    //     {
    //         code: "BOB",
    //         name: "Bank of Baroda",
    //         flag: false
    //     },
    //     {
    //         code: "INDUSIND",
    //         name: "INDUSIND Bank",
    //         flag: false
    //     },
    //     {
    //         code: "AXIS",
    //         name: "AXIS Bank",
    //         flag: false
    //     },
    //     {
    //         code: "KOTAK",
    //         name: "KOTAK Bank",
    //         flag: false
    //     },
    //     {
    //         code: "SBI",
    //         name: "SBI",
    //         flag: false
    //     },
    //     {
    //         code: "PNB",
    //         name: "PNB",
    //         flag: true
    //     },
    //     {
    //         code: "YES",
    //         name: "Yes Bank",
    //         flag: false
    //     },
    //     {
    //         code: "UNION",
    //         name: "Union Bank of India",
    //         flag: false
    //     },
    // ];

    const banks = <?php echo json_encode($bank_list, 15, 512) ?>;


    function createBankSelect(selectedBank) {
        // Create the base select element
        const selectElement = document.createElement('select');
        selectElement.innerHTML = `
        <option value="" selected hidden>Bank Name</option>
        ${banks.map(bank => `
            <option value="${bank.code}" ${selectedBank === bank.code ? 'selected' : ''}>
                ${bank.name}
            </option>
        `).join('')}
    `;
        return selectElement;
    }

    // Example usage in dynamic table row generation
    function addBankRow(selectedBank = '') {
        const tableCell = document.createElement('td');
        tableCell.setAttribute('data-label', 'Bank Name');
        tableCell.style.backgroundColor = '#eff0f3';

        const selectElement = createBankSelect(selectedBank); // Generate the select dynamically
        tableCell.appendChild(selectElement);

        // Append tableCell to your row dynamically
        // Example: yourRow.appendChild(tableCell);
    }

    function getBankOptions(selectedBank) {
        return banks.map(bank => `
        <option value="${bank.code}" ${selectedBank === bank.code ? 'selected' : ''}>
            ${bank.name}
            ${bank.Supported ? `<img src='<?php echo e(asset("assets_front/img/Items.png")); ?>' alt='Logo'>` : ''}
        </option>
    `).join('');
    }

    document.getElementById('add-file-btn').addEventListener('click', () => fileInput.click());

    ///U Changes Start

    document.getElementById('select-other-img').addEventListener('click', () => fileInput.click());

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
            <div class="file-size">${(file.size / (1024 * 1024)).toFixed(2)}mb</div>
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

            // Hide the upload progress modal after 5 seconds
            setTimeout(() => {
                hideUploadModal();
            }, 3000);
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
                // Iterate through each document and add a row for it
                data.documents.forEach(doc => {
                    console.log(doc);
                    addFileRow(doc);
                });

                // Update UI based on document count
                if (data.documents.length > 0) {
                    $('.thead-hide').hide();
                    $('.step-header-right').show();


                    runAnalysisButton.disabled = false;
                } else {
                    $('.thead-hide').show();
                    $('.step-header-right').hide();
                    runAnalysisButton.disabled = true;
                }
            } else {
                console.error("Error fetching documents:", data.error);
            }
        } catch (error) {
            console.error("Error fetching saved documents:", error);
        }
    };

    // Add a new file row to the table
    const addFileRow = (fileData) => {
        const {
            document_id,
            file_name,
            max_size,
            bank_name,
            pro_version,
            file_pwd,
            status,
            unique_file_name,
            upload_status,
            password_protected
        } = fileData;

        // Create a document fragment to hold both rows
        const fragment = document.createDocumentFragment();

        const full_bank_name = banks.find(bank => bank.code === bank_name);
        // if(full_bank_name){
        //     alert(`${full_bank_name.name}`);
        // }
        

        // Create the first row (file card)
        const fileCardRow = document.createElement('tr');
        fileCardRow.className = 'file-card';
        fileCardRow.setAttribute('data-document-id', document_id);
        fileCardRow.setAttribute('data-unique-file-name', unique_file_name);

        // Create the second row (controls)
        const controlsRow = document.createElement('tr');
        controlsRow.className = 'file-controls-row';

        // Set the HTML content for both rows
        fileCardRow.innerHTML = `
            <td colspan="5" style="padding: 0; border: 1px solid #dfe0eb; border-bottom: none; border-radius: 8px 8px 0 0;">
                <!-- Header Section -->
                <div class="file-header" style="padding:10px;">
                    <div class="file-header-left">
                        <div class="checkbox-wrapper" style="align-self: flex-start; position: relative; bottom: 5px; left:10px;">
                            <input type="checkbox" class="checkbox-input chq-bx ${upload_status==='s3' ? (pro_version == 'false' ? 'upgrade-plan' : '') : ''}" ${upload_status==='s3' ? '' : 'disabled'} ${upload_status==='s3' ? (pro_version == 'false' ? '' : 'checked') : ''}>
                        </div>
                        <div class="file-info">
                            <div class="file_details_mob">
                                <div class="file-info-label">Name<div class="colon-text" style="display: none;">:</div></div>
                                <div class="file-info-value">BANK_STATEMENT</div>
                            </div>
                            <div class="file_details_mob">
                                <div class="file-info-label">File Name<div class="colon-text" style="display: none;">:</div></div>
                                <div class="file-info-value" style="word-break: break-all;">${file_name}</div>
                            </div>
                            <div class="file_details_mob">
                                <div class="file-info-label">Format<div class="colon-text" style="display: none;">:</div></div>
                                <div class="file-info-value">${file_name.split('.').pop().toUpperCase()}</div>
                            </div>
                            <div class="file_details_mob">
                                <div class="file-info-label">Max Size(10mb)<div class="colon-text" style="display: none;">:</div></div>
                                <div class="file-info-value">${max_size}mb</div>
                            </div>
                        </div>
                    </div>
                    <button class="delete-btn">
                        <i class="fa fa-trash" style="color:#e12121;"></i>
                    </button>
                </div>
            </td>
        `;

        controlsRow.innerHTML = `
            <td colspan="5" style="padding: 0; border: 1px solid #dfe0eb; border-top: none; border-radius: 0 0 8px 8px; display: block; margin-bottom: 10px;">
                <!-- Controls Section -->
                <div class="file-controls" style="padding: 15px 20px; background-color:#f5f7fa; border-radius: 0 0 8px 8px;">
                    <div class="custom-dropdown">
                        <div class="selected-option ${upload_status==='s3' ? 'disabled-div-row' : ''}" data-value="${upload_status==='s3' ? bank_name : 'Select Bank'}" data-flag="${upload_status==='s3' ? pro_version : 'false'}" id="selectedBank_${document_id}" style="background: ${upload_status==='s3' ? '#edeef0' : '#fff'}; pointer-events: ${upload_status==='s3' ? 'none' : 'auto'};">${upload_status==='s3' ? full_bank_name.name : 'Select Bank'}</div>
                        <ul class="dropdown-options" id="bankOptions_${document_id}" style="padding-left: 0px; box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important; transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out; max-height: 200px; overflow-y: auto;">
                            <li style="padding: 5px;">
                                <input type="text" class="bank-search" placeholder="Search Bank..." style="width: 100%; padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                            </li>
                            ${banks.map(bank => `
                                <li class="dropdown-option" data-value="${bank.code}" data-flag="${bank.Supported}" data-bnk_nm="${bank.name}">
                                    <div class="bank-item">
                                        <span class="bank-name"  style="color: ${bank.Supported == true ? '#000' : '#a6a6a6'}">${bank.name}</span>
                                        ${!bank.Supported ? `
                                            <div class="bank-logo-container">
                                                <span class="only-on-text">only on</span>
                                                <img src='<?php echo e(asset("assets_front/img/Items.png")); ?>' alt='Logo' class="bank-logo">
                                            </div>
                                        ` : ''}
                                    </div>
                                </li>
                            `).join('')}
                        </ul>
                    </div>

                    <select class="form-select password-select ${upload_status==='s3' ? 'disabled-div-row' : ''}" ${upload_status==='s3' ? 'disabled' : ''} style="background: ${upload_status==='s3' ? '#edeef0' : '#fff'}">
                        <option value="" selected hidden>Is file password protected?</option>
                        <option value="No" ${password_protected === 'No' ? 'selected' : ''}>No</option>
                        <option value="Yes" ${password_protected === 'Yes' ? 'selected' : ''}>Yes</option>
                    </select>

                    <input type="password" ${upload_status==='s3' ? 'disabled' : ''} style="background: ${upload_status==='s3' ? '#edeef0' : '#fff'}" class="form-input enter-pass ${upload_status==='s3' ? 'disabled-div-row' : ''}" value="${file_pwd || ''}" ${!file_pwd ? 'readonly' : ''}>
                    
                    <button class="edit-btn" data-original-text="Edit" style="display: ${upload_status==='s3' ? 'block' : 'none'};">Edit</button>
                    <button class="save-btn make-center" style="width: 100%; display: ${upload_status==='s3' ? 'none' : 'block'};" data-original-text="Save">Save</button>
                </div>
            </td>
        `;

        // Add both rows to the fragment
        fragment.appendChild(fileCardRow);
        fragment.appendChild(controlsRow);

        // Add the fragment to the table body
        fileRows.appendChild(fragment);

        // Add event listeners
        setupRowEventListeners(fileCardRow, controlsRow, fileData);

        // Initialize custom dropdown functionality
        initializeCustomDropdown(document_id);
    };

    // Function to initialize custom dropdown functionality
    // function initializeCustomDropdown(documentId) {
    //     const selectedBank = document.getElementById(`selectedBank_${documentId}`);
    //     const bankOptions = document.getElementById(`bankOptions_${documentId}`);

    //     selectedBank.addEventListener('click', () => {
    //         bankOptions.style.display = bankOptions.style.display === 'block' ? 'none' : 'block';
    //     });

    //     bankOptions.querySelectorAll('.dropdown-option').forEach(option => {
    //         option.addEventListener('click', function() {
    //             const selectedValue = this.getAttribute('data-value');
    //             const selectedFlag = this.getAttribute('data-flag');
    //             selectedBank.textContent = selectedValue;
    //             selectedBank.setAttribute('data-flag', selectedFlag);
    //             bankOptions.style.display = 'none';
    //             // console.log('Selected bank code:', selectedValue);
    //         });
    //     });

    //     // Close the dropdown if clicked outside
    //     document.addEventListener('click', function(event) {
    //         if (!selectedBank.contains(event.target) && !bankOptions.contains(event.target)) {
    //             bankOptions.style.display = 'none';
    //         }
    //     });
    // }


    const setupRowEventListeners = (fileCardRow, controlsRow, fileData) => {
        // Delete button
        const deleteBtn = fileCardRow.querySelector('.delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', () =>
                deleteRow(fileData.document_id, fileData.unique_file_name, fileCardRow, controlsRow)
            );
        }

        // Password protection toggle
        const passwordSelect = controlsRow.querySelector('.password-select');
        const passwordInput = controlsRow.querySelector('.form-input');

        passwordSelect.addEventListener('change', () => {
            if (passwordSelect.value === 'Yes') {
                passwordInput.removeAttribute('readonly');
            } else {
                passwordInput.setAttribute('readonly', true);
                passwordInput.value = '';
            }
        });



        // Save button
        const saveBtn = controlsRow.querySelector('.save-btn');
        saveBtn.addEventListener('click', () => {
            // Get the selected option
            const selectedOption = controlsRow.querySelector('.custom-dropdown .selected-option');
            // Get the value of the selected option
            const selectedValue = selectedOption.textContent.trim();

            const saving_bank_code = banks.find(bank => bank.name === selectedValue);
            //alert(`${saving_bank_code.code}`);

            //save_bank_name = `${saving_bank_code.code}`;
            save_bank_name = saving_bank_code?.code || "Select Bank";


            const bankFlag = selectedOption.getAttribute('data-flag'); // Retrieve the flag value

            const passwordProtected = passwordSelect.value;
            const password = passwordInput.value.trim();

            if (!save_bank_name || save_bank_name === "Select Bank") {
                // alert("Please select a bank.");
                hideLoadingModal_msg('error', 'Please select a bank.');
                return;
            }

            if (!passwordProtected) {
                // alert("Please select if file is password protected or not.");
                hideLoadingModal_msg('error', 'Please select if file is password protected or not.');
                return;
            }

            if (passwordProtected === "Yes" && !password) {
                // alert("Please enter the password as the file is password protected.");
                hideLoadingModal_msg('error', 'Please enter the password as the file is password protected.');
                return;
            }

            updateDocument(
                fileData.document_id,
                fileData.unique_file_name,
                save_bank_name,
                bankFlag,
                passwordProtected,
                password,
                saveBtn,
                controlsRow
            );
        });

        // Add Edit button functionality
        const editBtn = controlsRow.querySelector('.edit-btn');
        editBtn.addEventListener('click', () => {
            // Hide edit button and show save button
            editBtn.style.display = 'none';
            const saveBtn = controlsRow.querySelector('.save-btn');
            saveBtn.style.display = 'block';
            saveBtn.style.opacity = 1;
            saveBtn.textContent = "Save";
            saveBtn.removeAttribute('disabled');
            saveBtn.style.backgroundColor = "#273896";

            // Enable all form controls
            const bankSelect = controlsRow.querySelector('.custom-dropdown .selected-option');
            const passwordSelect = controlsRow.querySelector('.password-select');
            const passwordInput = controlsRow.querySelector('.enter-pass');
            bankSelect.style.pointerEvents = 'auto'; // Enable interaction
            bankSelect.style.backgroundColor = '#fff';
            passwordSelect.style.background = '#fff';
            passwordInput.style.background = '#fff';

            // Remove disabled attribute
            passwordSelect.disabled = false;
            passwordInput.disabled = false;

            // Remove disabled-div-row class
            bankSelect.classList.remove('disabled-div-row');
            passwordSelect.classList.remove('disabled-div-row');
            passwordInput.classList.remove('disabled-div-row');
        });

        // Add event listener for checkboxes with class 'upgrade-plan'
        const checkbox = fileCardRow.querySelector('.checkbox-input');
        if (checkbox) {
            checkbox.addEventListener('click', (event) => {
                if (checkbox.classList.contains('upgrade-plan')) {
                    // alert("You need to upgrade your plan for choosing this bank");
                  //  hideLoadingModal_msg('error', 'You need to upgrade your plan for choosing this bank');
                  alert('You need to upgrade your plan for choosing this bank');
                    event.preventDefault(); // Prevent the checkbox from being checked
                    checkbox.checked = false; // Ensure the checkbox remains unchecked
                }
            });
        }

    };

    // Update document details via API
    const updateDocument = async (documentId, uniqueFileName, bankName, bankFlag, passwordProtected, password, saveBtn, row, nextRow) => {

        saveBtn.textContent = "Saving...";
        saveBtn.disabled = true;
        saveBtn.style.opacity = "0.7";

        


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
                    pro_version: bankFlag,
                    password_protected: passwordProtected,
                    password,
                    status: 'S3',
                }),
            });

            const data = await response.json();
            if (data.success) {
                // alert("Document updated successfully!");
                hideLoadingModal_msg('success', 'Document updated successfully!');

                // Hide save button and show edit button
                saveBtn.style.display = 'none';
                const editBtn = row.querySelector('.edit-btn');
                editBtn.style.display = 'block';

                // Disable all select boxes and input fields in the row
                const bankSelect = row.querySelector('.custom-dropdown .selected-option');
                const passwordSelect = row.querySelector('.password-select');
                const passwordInput = row.querySelector('.enter-pass');
                bankSelect.style.background = '#edeef0';
                passwordSelect.style.background = '#edeef0';
                passwordInput.style.background = '#edeef0';

                // bankSelect.disabled = true;
                bankSelect.style.pointerEvents = 'none';
                passwordSelect.disabled = true;
                passwordInput.disabled = true;

                bankSelect.classList.add('disabled-div-row');
                passwordSelect.classList.add('disabled-div-row');
                passwordInput.classList.add('disabled-div-row');

                // Find and check the checkbox in the parent file card row
                const fileCardRow = row.previousElementSibling; // Get the file card row

                if (fileCardRow) {
                    const checkbox = fileCardRow.querySelector('.checkbox-input');
                    if (checkbox) {
                        checkbox.removeAttribute('disabled'); // Enable the checkbox
                        checkbox.checked = true; // Check the checkbox

                        if (checkbox.classList.contains('upgrade-plan')) {
                            checkbox.classList.remove('upgrade-plan');
                        }
                    }
                }

                const check_bank = banks.find(bank => bank.code == bankName);

                const check_bank_flag = `${check_bank.Supported}`;

                if(check_bank_flag == 'false'){
                    if (fileCardRow) {
                        const checkbox = fileCardRow.querySelector('.checkbox-input');
                        if (checkbox) {
                            checkbox.removeAttribute('disabled'); // Enable the checkbox
                            checkbox.checked = false; // Check the checkbox

                            if (!checkbox.classList.contains('upgrade-plan')) {
                                checkbox.classList.add('upgrade-plan');
                            }

                        }
                    }
                }
                

                // Check if the selected bank has flag set to true
                // if (banks.find(bank => bank.code == bankName && bank.Supported)) {
                //     // If the bank has flag true, check and disable the checkbox of the previous row
                //     if (fileCardRow) {
                //         const checkbox = fileCardRow.querySelector('.checkbox-input');
                //         if (checkbox) {
                //             checkbox.removeAttribute('disabled'); // Enable the checkbox
                //             checkbox.checked = false; // Check the checkbox

                //             if (!checkbox.classList.contains('upgrade-plan')) {
                //                 checkbox.classList.add('upgrade-plan');
                //             }

                //         }
                //     }
                // }

            } else {
                // Reset button if failed
                saveBtn.textContent = saveBtn.getAttribute('data-original-text');
                saveBtn.disabled = false;
                saveBtn.style.opacity = "1";
                // alert(`Error updating document: ${data.error}`);
                hideLoadingModal_msg('error', `${data.error}`);
            }
        } catch (error) {
            // Reset button if error occurs
            saveBtn.textContent = saveBtn.getAttribute('data-original-text');
            saveBtn.disabled = false;
            saveBtn.style.opacity = "1";
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
                // Check if there are any remaining rows
                if (fileRows.childElementCount === 0) {
                    // No more rows, show thead-hide and hide step-header-right
                    $('.thead-hide').show();
                    $('.step-header-right').hide();
                    runAnalysisButton.disabled = true;
                    downloadOutputButton.disabled = true;
                } else {
                    runAnalysisButton.disabled = false;
                    downloadOutputButton.disabled = true;
                }
                // runAnalysisButton.disabled = !checkFileSizes();
            } else {
                // alert(`Error deleting document: ${data.error}`);
                hideLoadingModal_msg(`error`, `Error deleting document: ${data.error}`);
            }
        } catch (error) {
            console.error("Error deleting document:", error);
            // runAnalysisButton.disabled = !checkFileSizes();
        }
    };

    // Handle file uploads
    fileInput.addEventListener('change', () => {
        let errorMessages = [];
        [...fileInput.files].forEach(file => {

            const uniqueFileName = `${Date.now()}_${file.name}`;
            const maxFileSize = (file.size / (1024 * 1024)).toFixed(2);

            const maxAllowedSize = 10; // Max allowed file size in MB
            const allowedExtension = ".pdf";
            const fileExtension = file.name.slice(file.name.lastIndexOf(".")).toLowerCase();


            if (fileExtension !== allowedExtension) {

                errorMessages.push(`The file "${file.name}" is not a valid ${allowedExtension} file. Please upload a PDF file.`);
                // Call the error notification function
                //showErrorNotification(errorMessage, 'error');
                return; // Stop further processing
            }
            if (maxFileSize > maxAllowedSize) {

                errorMessages.push(`The file "${file.name}" exceeds the maximum allowed size of ${maxAllowedSize} MB. Current size: ${maxFileSize} MB.`);
                // Call the error notification function

                return; // Stop further processing
            }
            showUploadModal();
            addFileToUploadModal(file);

            $('.thead-hide').hide();
            // $('.thead-show').show();
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

        if (errorMessages.length > 0) {
            const errorMessage = errorMessages.join('\n'); // Combine all error messages into a single string
            showErrorNotification(errorMessage, 'error', 10000);
            return; // Stop further processing
        }
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
            //alert('Please select at least one file to analyze.');
            hideLoadingModal_msg('error', 'Please select at least one file to analyze.');

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

                // const checkbox = nextRow.querySelector('.checkbox-input');
                // checkbox.removeAttribute('disabled');
                // checkbox.checked = true;

                downloadOutputButton.disabled = false;
                showLoadingModal();

                //hideLoadingModal();
                //downloadOutputButton.disabled = false;
                //hideLoadingModal_msg('success', 'Your Bank Statement Analysis is ready.');
                //alert('Analysis started successfully! Check the analysis results later.');
                // Optionally, update the UI or redirect
            } else {
                //alert('Error: ' + data.error);
                hideLoadingModal_msg('error', data.error || 'Please Try again');

            }
        } catch (error) {
            console.error('Error:', error);
            // alert('There was an error starting the analysis.');
            hideLoadingModal_msg('error', data.error || 'There was an error starting the analysis. Please Try again');
        }
    }
    //});
</script>


<script>
    downloadOutputButton.addEventListener('click', async () => {
        try {
            const response = await fetch('/customer/download-report', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({
                    document_id: 1 // Replace with dynamic data if needed
                }),
            });

            console.log('Response status:', response.status);

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            // Attempt to parse JSON safely
            let data;
            try {
                data = await response.json();
            } catch (e) {
                console.error('Failed to parse JSON:', e);
                const textResponse = await response.text(); // Fallback: Get raw text to debug
                console.error('Response text:', textResponse);
                //hideLoadingModal_msg('error', 'Unexpected server response.');
                showErrorNotification('Unexpected server response.', 'error');
                return;
            }

            console.log('Response JSON:', data);

            if (data.success && data.file_url) {
                const fileLink = document.createElement('a');
                fileLink.href = data.file_url;
                fileLink.download = ''; // Let the browser use the filename from the response
                document.body.appendChild(fileLink);
                fileLink.click();
                document.body.removeChild(fileLink);
            } else {
                let downloadstatus = data.status;
                if (downloadstatus == 'blank') {
                    showErrorNotification(data.message, 'error');
                } else if (downloadstatus == 'failed') {
                    showErrorNotification(data.message, 'error');
                } else if (downloadstatus == 'processing') {
                    // showErrorNotification('The download is still processing. Please wait and try again later.', 'info');
                    showLoadingModal();
                }



            }
        } catch (error) {
            console.error('Error:', error);
            //hideLoadingModal_msg('error',  error || 'An error occurred while downloading the file.');
            showErrorNotification(error || 'An error occurred while downloading the file.', 'error');

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


    function hideModaltop() {
        modal.style.display = 'none';
        // Scroll to the top of the page
        window.scrollTo({
            top: 0,
            behavior: 'smooth' // Smooth scrolling
        });
    }

    // Event listeners for buttons
    document.querySelector('.yes-btn').addEventListener('click', hideModaltop);
    document.querySelector('.no-btn').addEventListener('click', () => {

        hideModal();
        //showLoadingModal();
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

        // Show notification immediately after hiding loading modal
        showNotification();

    }

    function hideLoadingModal_msg(error, msg) {
        const loadingModal = document.getElementById('loadingModal');
        loadingModal.style.display = 'none';



        showErrorNotification(msg, error);
        // Show notification immediately after hiding loading modal
        //showNotification();

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


    function showErrorNotification(message, type = 'success', time = 5000) {
        //alert('Hello');
        const notification = document.getElementById('notification');
        const notificationText = document.getElementById('notification-text');

        const notificationContainer = document.querySelector('.notification-container');
        notificationContainer.style.display = 'block';

        // Set the notification message and class
        notificationText.innerText = message;
        notification.className = `notification ${type}`; // Add class dynamically
        notification.style.display = 'flex'; // Show the notification

        // Automatically hide the notification after 3 seconds
        setTimeout(() => {
            notification.style.display = 'none';
            hideNotification();
        }, time);
    }
</script>



<script>
    // function initializeCustomDropdown(documentId) {
    //     const selectedBank = document.getElementById(`selectedBank_${documentId}`);
    //     const bankOptions = document.getElementById(`bankOptions_${documentId}`);
    //     const searchInput = bankOptions.querySelector('.bank-search'); // Get the search input

    //     // Show/hide dropdown and reset search input when selected bank is clicked
    //     selectedBank.addEventListener('click', () => {
    //         bankOptions.style.display = bankOptions.style.display === 'block' ? 'none' : 'block';
    //         searchInput.value = ''; // Clear previous search
    //         filterOptions(searchInput, bankOptions); // Reset filter
    //     });

    //     // Filter options based on search input
    //     searchInput.addEventListener('input', () => {
    //         filterOptions(searchInput, bankOptions);
    //     });



    //     // Handle option selection
    //     bankOptions.querySelectorAll('.dropdown-option').forEach(option => {
    //         option.addEventListener('click', function() {
    //             const selectedValue = this.getAttribute('data-value');
    //             const selectedFlag = this.getAttribute('data-flag');
    //             const sel_full_bank_name = banks.find(bank => bank.code === selectedValue);
    //             // alert(`${sel_full_bank_name.name}`);
    //             selectedBank.textContent = `${sel_full_bank_name.name}`;
    //             selectedBank.setAttribute('data-flag', selectedFlag);
    //             bankOptions.style.display = 'none';
    //             // console.log('Selected bank code:', selectedValue);
    //         });
    //     });

    //     // Close dropdown if clicking outside
    //     document.addEventListener('click', function(event) {
    //         if (!selectedBank.contains(event.target) && !bankOptions.contains(event.target)) {
    //             bankOptions.style.display = 'none'; // Hide dropdown
    //         }
    //     });
    // }

    function initializeCustomDropdown(documentId) {
        const selectedBank = document.getElementById(`selectedBank_${documentId}`);
        const bankOptions = document.getElementById(`bankOptions_${documentId}`);
        const searchInput = bankOptions.querySelector('.bank-search'); // Get the search input

        // Show/hide dropdown and reset search input when selected bank is clicked
        selectedBank.addEventListener('click', () => {
            bankOptions.style.display = bankOptions.style.display === 'block' ? 'none' : 'block';
            searchInput.value = ''; // Clear previous search
            filterOptions(searchInput, bankOptions); // Reset filter

            // Increase the width of the dropdown to fit the content
            bankOptions.style.width = 'max-content'; // Allow the width to expand based on content
            searchInput.style.width = '100%'; // Allow the search input to expand based on content
        });

        // Filter options based on search input
        searchInput.addEventListener('input', () => {
            filterOptions(searchInput, bankOptions);
        });



        // Handle option selection
        bankOptions.querySelectorAll('.dropdown-option').forEach(option => {
            option.addEventListener('click', function() {
                const selectedValue = this.getAttribute('data-value');
                const selectedFlag = this.getAttribute('data-flag');
                const sel_full_bank_name = banks.find(bank => bank.code === selectedValue);
                selectedBank.textContent = `${sel_full_bank_name.name}`;
                selectedBank.setAttribute('data-flag', selectedFlag);
                bankOptions.style.display = 'none';

                // Reset the dropdown width and search input width back to their original state
                bankOptions.style.width = 'max-width'; // Set back to original width
                searchInput.style.width = 'max-width'; // Set back to original width
            });
        });

        // Close dropdown if clicking outside
        document.addEventListener('click', function(event) {
            if (!selectedBank.contains(event.target) && !bankOptions.contains(event.target)) {
                bankOptions.style.display = 'none'; // Hide dropdown
                bankOptions.style.width = '100%'; // Reset width
                searchInput.style.width = '100%'; // Reset search input width
            }
        });
    }

    // Function to filter dropdown options based on search input
    function filterOptions(searchInput, bankOptions) {
        const filter = searchInput.value.toLowerCase(); // Get the search input value
        const options = bankOptions.querySelectorAll('.dropdown-option:not(:first-child)'); // Exclude the first child (search input)

        // Show or hide options based on the search input
        options.forEach(option => {
            const text = option.getAttribute('data-bnk_nm').toLowerCase(); // Get the text of the option
            option.style.display = text.includes(filter) ? 'block' : 'none'; // Show or hide option
        });
    }

    // Initialize the custom dropdown for each document (you may need to adjust this based on your implementation)
    document.addEventListener('DOMContentLoaded', function() {
        const documentIds = [ /* Array of document IDs */ ]; // Replace with actual document IDs
        documentIds.forEach(id => initializeCustomDropdown(id));
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const status = "<?php echo e($status); ?>"; // Passed from the backend
        const message = "<?php echo e($message); ?>";
        const rid = "<?php echo e($rid); ?>"; // Passed from the backend

        if (status === 'failed') {
            showErrorNotification(message, 'error');
            updateNotificationStatus(rid, 2); // 2 for failed
        } else if (status === 'completed') {
            showErrorNotification(message, 'success');
            updateNotificationStatus(rid, 1); // 1 for completed
        } else if (status === 'processing') {
            // showErrorNotification(message, 'success');
            // updateNotificationStatus(rid, 1); // 1 for completed
            showLoadingModal();
        }
    });

    function updateNotificationStatus(rid, status) {
        const apiUrl = '/customer/update-notification-status'; // Adjust this API endpoint

        fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    rid: rid,
                    notification_status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    //showErrorNotification(data.message || 'Failed to update notification status.', 'error');
                }
            })
            .catch(error => {
                //showErrorNotification('An error occurred while updating the notification status.', 'error');
                console.error('API Error:', error);
            });
    }
</script>


<script>
    // Get the button
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    // Show the button when scrolling down
    window.onscroll = function() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollToTopBtn.style.display = "flex"; // Show button
        } else {
            scrollToTopBtn.style.display = "none"; // Hide button
        }
    };

    // Scroll to top when the button is clicked
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script><?php /**PATH C:\xampp81New\htdocs\pws_bsa_25feb\bsa\resources\views/frontend/analyze_bs.blade.php ENDPATH**/ ?>