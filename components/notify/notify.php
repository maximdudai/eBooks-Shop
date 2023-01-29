<?php 
    function displayNotify($text) {
        echo '
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" 
                style="
                    position: fixed;
                    bottom: 5px;
                    left: 5px;
                    right: 50;
                    z-index: 2025;
                    font-weight: 600;
                ">

                <div class="toast-header">
                    <i class="bi bi-bell"></i>
                    <strong class="me-auto">book\'Shop</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    '.$text.'
                </div>
            </div>
            <script type="text/javascript" src="../../../shop/components/notify/notify.js"></script>
        ';
    }
?>