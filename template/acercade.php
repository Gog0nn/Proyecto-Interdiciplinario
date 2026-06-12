<?php include(__DIR__ . "/parciales/templateStart.php");?>
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <h1 class="display-4 fw-bold mb-4">Sobre Nosotros</h1>
            <p class="lead">El Club Sacachispas de Encarnación, Paraguay, mantiene una activa actividad en el básquetbol, enfocándose tanto en la competencia como en la inclusión deportiva.</p>
            
            <div class="display-4 fw-bold mb-4">
                <h5 class="fw-bold text-primary"><i class="bi bi-trophy me-2"></i>Actividades Recientes</h5>
                <p class="lead">Torneo Interno: En enero de 2023, el club organizó un torneo interno con exjugadores de todas las edades, disputado en su sede ubicada en la calle Juan León Mallorquín.</p>
            </div>

            <div class="display-4 fw-bold mb-4">
                <h5 class="fw-bold text-success"><i class="bi bi-heart me-2"></i>Básquet Inclusivo</h5>
                <p class="lead">El "Team Angiru" reúne a más de 30 participantes con diversas capacidades. Prácticas: Martes y jueves de 16:00 a 17:15 horas.</p>
            </div>
        </div>

        <div class="col-lg-6">
            <!-- Carrusel de Imágenes -->
            <div id="carouselSacachispas" class="carousel slide shadow-lg rounded-4 overflow-hidden border" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="img/sacachispas.png" class="d-block w-100 p-4 bg-white" alt="Ilustración Sacachispas" style="height: 400px; object-fit: contain;">
                    </div>
                    <div class="carousel-item">
                        <img src="img/image.png" class="d-block w-100 p-5 bg-white" alt="Escudo Sacachispas" style="height: 400px; object-fit: contain;">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselSacachispas" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselSacachispas" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__ . "/parciales/templateEnd.php");?>
