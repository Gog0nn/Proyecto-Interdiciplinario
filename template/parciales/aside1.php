<aside class="col-2 p-3">
    <div class="mb-3">Menú</div>
    <div class="list-group">
        <!-- Ítem con colapsable -->
        <button class="list-group-item list-group-item-action d-flex justify-content-between align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#eventosDetalle">
            <span><i class="bi bi-calendar-event"></i> Proximos eventos</span>
            <i class="bi bi-chevron-down small"></i>
        </button>
        
        <div class="collapse" id="eventosDetalle">
            <div class="list-group list-group-flush ps-3 bg-light">
                <a href="#" class="list-group-item list-group-item-action border-0 py-1 small italic">vs Club Rivadavia - 20hs</a>
                <a href="#" class="list-group-item list-group-item-action border-0 py-1 small">Torneo Local - Sab 15/05</a>
            </div>
        </div>

        <a href="<?= BASE_URL ?>/eventos/index.php" class="list-group-item list-group-item-action"><i class="bi bi-calendar-check"></i> Todos los Eventos</a>
        <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-gear"></i> Entrenadores</a>
    </div>
</aside>
