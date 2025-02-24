<!-- Loader -->
<div class="loader">
    <div class="spinner"></div>
    <div class="text">MINISTERIO PÚBLICO</div>
    <div class="text2">FISCALÍA DE LA NACIÓN</div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Loader
        setTimeout(() => {
            document.querySelector('.loader').classList.add('fade-out');
            setTimeout(() => {
                document.querySelector('.loader').style.display = 'none';
            }, 1000); // Espera que la animación de desvanecimiento termine
        }, 2000);
    });
</script>
<style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }

    body {
        user-select: none;
        -webkit-user-select: none;
        /* Para navegadores basados en WebKit */
        -moz-user-select: none;
        /* Para navegadores basados en Firefox */
        -ms-user-select: none;
        /* Para Internet Explorer/Edge */
    }

    .navbar {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #002856;
        color: white;
        width: 100%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        background-color: #002856;
        font-weight: bold;
    }

    .navbar-brand img {
        width: 35px;
        height: auto;
        margin-right: 10px;
    }

    .navbar-toggler-icon {
        background-color: white;
    }

    .card {
        background-color: rgba(0, 0, 0, 0.1);
        /* Color de fondo transparente oscuro */
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        margin: 1rem;
        transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
        opacity: 0;
        /* Inicialmente invisible */
        transform: translateY(20px);
        /* Inicialmente desplazado hacia abajo */
    }

    .card-body {
        padding: 1rem;
        text-align: center;
    }

    .card-title {
        font-size: 1.125rem;
        margin-bottom: 0.75rem;
        color: #002856;
        font-weight: 600;
    }

    .card img {
        width: 55%;
        height: auto;
        margin-bottom: 1rem;
        filter: grayscale(100%);
        transition: filter 0.3s;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    .card {
        flex: 1 1 calc(30% - 2rem);
        margin: 1rem;
        max-width: calc(30% - 2rem);
    }

    @media (max-width: 992px) {
        .card {
            flex: 1 1 calc(50% - 2rem);
            max-width: calc(50% - 2rem);
        }
    }

    @media (max-width: 768px) {
        .navbar {
            background-color: #002856;
            color: white;
            width: 111%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card {
            flex: 1 1 calc(100% - 2rem);
            max-width: calc(100% - 2rem);
        }
    }

    .card:hover {
        background-color: #ffffff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
        transform: scale(1.05);
        cursor: pointer;
        border: 3px dashed #002856;
    }

    .card:hover img {
        filter: grayscale(0%);
    }

    .fade-in {
        animation: fadeIn 1s ease-out forwards;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .loader {
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

    .spinner {
        border: 8px solid rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        border-top: 8px solid #FFC107;
        /* Color amarillo oscuro */
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }

    .text {
        color: #FFC107;
        /* Color amarillo oscuro */
        font-size: 1.2rem;
        margin: 0 auto;
        font-weight: 700;
        margin-top: 20px;
    }

    .text2 {
        color: #FFC107;
        /* Color amarillo oscuro */
        font-size: 1rem;
        margin: 0 auto;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .fade-out {
        opacity: 0;
        transition: opacity 1s ease-out;
    }
</style>