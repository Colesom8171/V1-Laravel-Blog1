

import $ from 'jquery';
import 'datatables.net';
//import 'datatables.net-dt/css/dataTables.min.css';
import 'datatables.net-dt/css/jquery.dataTables.min.css';
// El resto de tu código JavaScript

import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
        $(document).ready(function() {
            $('#myTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthMenu": [5, 10, 25, 50, 100], // Opciones para mostrar filas por página
            "language": {
                "search": "Buscar:",
                "lengthMenu": "Mostrar _MENU_ entradas",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "No hay entradas disponibles",
                "infoFiltered": "(filtrado de _MAX_ entradas totales)"
            }
        });
    });
});