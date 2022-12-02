@include('pages.templates.template-parts.home.banner',[compact('page')])
@include('pages.templates.template-parts.home.testimonialsList',[compact('page')])
@include('pages.templates.template-parts.home.asdasd',[compact('page')])




<script>
    $('.multiple-select').select2({
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
</script>
