<!-- Loader -->
<div class="custom-loader" style="z-index: 1000000;">
    <div class="custom-spinner"></div>
    <div class="custom-text">MINISTERIO PÚBLICO</div>
    <div class="custom-text2">FISCALÍA DE LA NACIÓN</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Loader
        setTimeout(() => {
            document.querySelector('.custom-loader').classList.add('custom-fade-out');
            setTimeout(() => {
                document.querySelector('.custom-loader').style.display = 'none';
            }, 1000); // Espera que la animación de desvanecimiento termine
        }, 2000);
    });
</script>

<style>
    .custom-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #002856;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        opacity: 1;
        transition: opacity 1s ease-out;
    }

    .custom-spinner {
        border: 8px solid rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        border-top: 8px solid #FFC107;
        /* Color amarillo oscuro */
        width: 50px;
        height: 50px;
        animation: custom-spin 1s linear infinite;
        margin: 0 auto;
    }

    .custom-text {
        color: #FFC107;
        /* Color amarillo oscuro */
        font-size: 1.2rem;
        margin: 0 auto;
        font-weight: 700;
        margin-top: 20px;
    }

    .custom-text2 {
        color: #FFC107;
        /* Color amarillo oscuro */
        font-size: 1rem;
        margin: 0 auto;
    }

    @keyframes custom-spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .custom-fade-out {
        opacity: 0;
        transition: opacity 1s ease-out;
    }
</style>
