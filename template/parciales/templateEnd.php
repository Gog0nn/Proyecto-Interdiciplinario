                </main>
            </main>
        </div>    
    </div>

    <!-- El footer se posiciona a lo ancho completo de la pantalla -->
    <!--php include "footer.php"; -->

    <script src="/assets/DataTables/datatables.min.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebarToggle');
        const appSidebar = document.getElementById('appSidebar');
        if (sidebarToggle && appSidebar) {
            sidebarToggle.addEventListener('click', () => {
                const collapsed = appSidebar.classList.toggle('is-collapsed');
                sidebarToggle.classList.toggle('is-collapsed', collapsed);
                sidebarToggle.setAttribute('aria-expanded', String(!collapsed));
                sidebarToggle.title = collapsed ? 'Mostrar menú' : 'Ocultar menú';
                sidebarToggle.querySelector('i').className = 'bi bi-list';
            });
        }

        document.querySelectorAll('table[data-datatable]').forEach((table) => {
            const columnas = (valor) => (valor || '').split(',').filter(Boolean).map(Number);
            const sinOrden = columnas(table.dataset.datatableNoOrder);
            const sinBusqueda = columnas(table.dataset.datatableNoSearch);

            new DataTable(table, {
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    emptyTable: 'No hay datos disponibles',
                    info: 'Mostrando _START_ a _END_ de _TOTAL_ registros',
                    infoEmpty: 'Mostrando 0 a 0 de 0 registros',
                    infoFiltered: '(filtrado de _MAX_ registros)',
                    lengthMenu: 'Mostrar _MENU_ registros',
                    search: 'Buscar:',
                    zeroRecords: 'No se encontraron registros',
                    paginate: {
                        first: 'Primero',
                        last: 'Último',
                        next: 'Siguiente',
                        previous: 'Anterior'
                    }
                },
                columnDefs: [
                    ...(sinOrden.length ? [{ target: sinOrden, orderable: false }] : []),
                    ...(sinBusqueda.length ? [{ target: sinBusqueda, searchable: false }] : [])
                ]
            });
        });
    </script>
    <script src="/assets/Bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>