@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

@section('title')
    {{ trans('myClasses_trans.tittle_page') }}
    @stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('myClasses_trans.tittle_page') }}
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button type="button" class="btn btn-success btn-sm px-3 shadow-sm" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i> {{ trans('myClasses_trans.add_class') }}
                        </button>
                    
                        <button type="button" class="btn btn-danger btn-sm px-3 shadow-sm" id="btn_delete_all">
                            <i class="fa fa-trash"></i> {{ trans('myClasses_trans.delete_checkBox') }}
                        </button>
                    </div>
                    
                    <form action="{{ route('classrooms.filter') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row justify-content-start">
                            <div class="col-md-5">
                                <label for="Grade_id" class="form-label fw-bold text-primary mb-2">
                                    <i class="bi bi-funnel-fill me-1"></i> 
                                    {{ trans('myClasses_trans.SearchByGrade') }}
                                </label>
                    
                                <div class="input-group shadow-sm">
                                    <span class="input-group-text bg-info text-white rounded-start-pill">
                                        <i class="bi bi-layers"></i>
                                    </span>
                                    <select name="Grade_id" id="Grade_id" 
                                            class="form-select border-info shadow-sm rounded-end-pill" 
                                            required onchange="this.form.submit()">
                                        
                                        <option value="" disabled {{ request('Grade_id') ? '' : 'selected' }}>
                                            -- {{ trans('myClasses_trans.SearchByGrade') }} --
                                        </option>
                                        
                                        <option value="all" {{ old('Grade_id', request('Grade_id')) == 'all' ? 'selected' : '' }}>
                                            {{ trans('myClasses_trans.allClasses') }}
                                        </option>
                        
                                        @foreach ($Grades as $grade)
                                            <option value="{{ $grade->id }}" 
                                                {{ old('Grade_id', request('Grade_id')) == $grade->id ? 'selected' : '' }}>
                                                {{ $grade->Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                    
                    
                    </form>
                    

                    
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="select_all" id="example_select_all" onclick="CheckAll('box1',this)">
                                    </th>
                                    <th>#</th>
                                    <th>{{ trans('myClasses_trans.stage_name_ar') }}</th>
                                    <th>{{ trans('myClasses_trans.name_grade') }}</th>
                                    <th>{{ trans('myClasses_trans.proccess') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($details))
                                <?php $List_Classes=$details ?>
                                @else
                                <?php$List_Classes=$myClasses ?>
                                @endif
                                <?php $i = 0; ?>
                                @foreach ($List_Classes as $My_Class)
                                    <tr>
                                        <?php    $i++; ?>
                                        <td><input type="checkbox" value="{{ $My_Class->id }}" class="box1">
                                        </td>
                                        <td>{{ $i }}</td>
                                        <td>{{ $My_Class->Name_class }}</td>
                                        <td>{{ $My_Class->Grades->Name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $My_Class->id }}"
                                                title="{{ trans('grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#delete{{ $My_Class->id }}"
                                                title="{{ trans('grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                <br><br>
                                           
                                        </td>
                                    </tr>

                                    <!-- edit_modal_Grade -->
                                    <div class="modal fade" id="edit{{ $My_Class->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">
                                                        {{ trans('myClasses_trans.edit_class') }}
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- add_form -->
                                                    <form action="{{ route('classrooms.update', $My_Class->id) }}" method="post">
                                                        @method('put')
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="row">
                                                    
                                                                <div class="col">
                                                                    <label for="Name" class="mr-sm-2">
                                                                        {{ trans('myClasses_trans.name_class_ar') }} :
                                                                    </label>
                                                                    <input class="form-control" 
                                                                            type="text" 
                                                                            name="Name" 
                                                                            value="{{ old('Name', $My_Class->getTranslation('Name_class','ar')) }}">
                                                            </div>
                                                    
                                                                <div class="col">
                                                                    <label for="Name_class_en" class="mr-sm-2">
                                                                        {{ trans('myClasses_trans.name_class_en') }} :
                                                                    </label>
                                                                    <input class="form-control" 
                                                                            type="text" 
                                                                            name="Name_class_en" 
                                                                            value="{{ old('Name_class_en', $My_Class->getTranslation('Name_class','en')) }}">
                                                                        </div>
                                                                <div class="col">
                                                                    <label for="Grade_id" class="mr-sm-2">
                                                                        {{ trans('myClasses_trans.name_grade') }} :
                                                                    </label>
                                                                    <div class="box">
                                                                        <select class="fancyselect" name="Grade_id">
                                                                            <option value="" selected disabled>{{ trans('myClasses_trans.name_grade') }}</option>
                                                                            @foreach ($Grades as $Grade)
                                                                                <option value="{{ $Grade->id }}"
                                                                                    {{ $Grade->id == $My_Class->Grade_id ? 'selected' : '' }}>
                                                                                    {{ $Grade->Name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                    
                                                            </div>
                                                    
                                                            <div class="modal-footer mt-3">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                                    {{ trans('grades_trans.Close') }}
                                                                </button>
                                                                <button type="submit" class="btn btn-success">
                                                                    {{ trans('grades_trans.submit') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- delete_modal_Classroom -->
                                    <div class="modal fade" id="delete{{ $My_Class->id }}" tabindex="-1"
                                        aria-labelledby="deleteLabel{{ $My_Class->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteLabel{{ $My_Class->id }}">
                                                        {{ trans('myClasses_trans.delete_class') }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="{{ trans('close') }}">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ trans('myClasses_trans.warnning_class') }}:
                                                    <s>{{ $My_Class->Name }}</s>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{ trans('myClasses_trans.cancel') }}</button>

                                                    <form action="{{ route('classrooms.destroy', $My_Class->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    <input type="hidden" name="id" value="{{ $My_Class->id }}">
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ trans('myClasses_trans.confirm_delete') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ trans('myclasses_trans.add_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class=" row mb-30" action="{{ route('classrooms.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Classes">
                                        <div data-repeater-item>
                                            <div class="row">

                                                <div class="col">
                                                    <label for="Name"
                                                        class="mr-sm-2">{{ trans('myClasses_trans.name_class_ar') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="Name" />
                                                </div>


                                                <div class="col">
                                                    <label for="Name"
                                                        class="mr-sm-2">{{ trans('myClasses_trans.name_class_en') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="Name_class_en" />
                                                </div>


                                                <div class="col">
                                                    <label for="Name_en"
                                                        class="mr-sm-2">{{ trans('myClasses_trans.name_grade') }}
                                                        :</label>

                                                    <div class="box">
                                                        <select class="fancyselect" name="Grade_id">
                                                            <option value="" selected disabled>
                                                                {{ trans('myClasses_trans.name_grade') }}</option>
                                                            @foreach ($Grades as $Grade)
                                                                <option value="{{ $Grade->id }}">{{ $Grade->Name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <label for="Name_en"
                                                        class="mr-sm-2">{{ trans('myClasses_trans.proccess') }}
                                                        :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                        type="button" value="{{ trans('myClasses_trans.delete_row') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button"
                                                value="{{ trans('myClasses_trans.add_row') }}" />
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('grades_trans.Close') }}</button>
                                        <button type="submit"
                                            class="btn btn-success">{{ trans('grades_trans.submit') }}</button>
                                    </div>


                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>
                                        
        </div>
    </div>
    <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('myClasses_trans.delete_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route(name: 'delete_all') }}" method="POST">
                @csrf
                @method('delete')
                <div class="modal-body">
                    {{ trans('myClasses_trans.warnning_class') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('myClasses_trans.close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('myClasses_trans.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
    </div>

    </div>

    <!-- row closed -->
@endsection
@section('js')
<script>
    function CheckAll(className,elem){
        var elements =document.getElementsByClassName(className);
        var l = elements.length;
        if(elem.checked){
            for(var i=0; i<l;i++)
            {
                elements[i].checked=true;
            }     
    }else{
        for(var i=0; i<l;i++)
            {
                elements[i].checked=false;
            }     
    }
    }
</script>
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });

</script>
@endsection