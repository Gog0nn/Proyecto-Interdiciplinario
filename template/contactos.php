<?php include(__DIR__ . "/parciales/templateStart.php"); ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                    <h2 class="mb-0 fw-bold"><i class="bi bi-envelope-paper me-2"></i>Contáctanos</h2>
                    <p class="mb-0 opacity-75">Envíanos tus dudas o consultas</p>
                </div>
                <div class="card-body p-4">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-semibold"><i class="bi bi-person me-1"></i>Nombre Completo:</label>
                            <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Tu nombre..." required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold"><i class="bi bi-at me-1"></i>Correo Electrónico:</label>
                            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="ejemplo@correo.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensaje" class="form-label fw-semibold"><i class="bi bi-chat-left-text me-1"></i>Mensaje:</label>
                            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" placeholder="Escribe tu mensaje aquí..." required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                Enviar Mensaje <i class="bi bi-send ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-light text-center py-3 rounded-bottom-4">
                    <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>Juan León Mallorquín, Encarnación - Paraguay</small>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include(__DIR__ . "/parciales/templateEnd.php"); ?>
