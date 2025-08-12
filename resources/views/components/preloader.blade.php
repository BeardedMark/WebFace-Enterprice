<div id="preloader" style="display: none;" class="preloader-overlay">
    <div class="preloader-spinner"></div>
</div>

<style>
    .preloader-overlay {
        position: fixed;
        z-index: 9999;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preloader-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #ccc;
        border-top-color: #3498db;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>

<script>
    window.showPreloader = () => {
        document.getElementById('preloader').style.display = 'flex';
    };

    window.hidePreloader = () => {
        document.getElementById('preloader').style.display = 'none';
    };

</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        showPreloader();
    });

    window.addEventListener("load", () => {
        hidePreloader();
    });
</script>
