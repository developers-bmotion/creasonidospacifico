@push('css')
    <link rel="stylesheet" href="/backend/admin/css/dashboard.css">
@endpush
@include('backend.admin.projects-admin')



@push('js')
    <script>
    setUrl("proyectosNuevos", "{{ route("admin.projects_news") }}");
    setUrl("topCountry", "{{ route("admin.top_country") }}");
    setText("proyectosRevision", "{{ __("proyectos_en_revicion_chart")}}");
    </script>
    <script src="/backend/assets/vendors/custom/flot/flot.bundle.min.js"></script>
    <script src="/js/storage.js"></script>
    <script src="/js/ajax.js"></script>
    <script src="/js/daterangepicker.js"></script>
    <script src="/backend/admin/js/dashboard.js"></script>


    <script src="/backend/assets/vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
    <script src="/backend/assets/demo/custom/crud/datatables/basic/headers.js" type="text/javascript"></script>


@endpush
