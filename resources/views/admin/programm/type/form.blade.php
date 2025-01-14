@extends("adminlte::page")

@section("content_header")
    <h1>Programmpunkt-Typen</h1>
@endsection

<?php
if (isset($type)) {
    $action = "/admin/type/" . $type->id;
    $patch = true;
    $h3 = "Ort $type->name bearbeiten";

} else {
    $type = new \App\Models\Type();
    $action = "/admin/type";
    $patch = false;
    $h3 = "neuen Ort anlegen";
}
?>

@section("content")

    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $h3 }}</h3>
                </div>

                <form action="{{ $action }}" method="POST">
                    @csrf
                    @if($patch)
                        @method('PATCH')
                    @endif
                    <div class="card-body">

                        <div class="row">
                            <div class="col-12">
                                <x-dc.admin.form.input
                                    name="name"
                                    label="Name"
                                    value="{{ $type->name }}"
                                    required
                                />
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <x-dc.admin.form.submit/>
                    </div>
                </form>

            </div>
        </div>
    </div>



    @if($patch)
        <x-dc.admin.delete_section name="Programmpunkt-Typ" action="/admin/type/{{$type->id}}"/>
    @endif
@endsection
