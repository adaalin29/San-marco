@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
@endphp
@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="{{ $edit ? route('voyager.'.$dataType->slug.'.update', $dataTypeContent->getKey()) : route('voyager.'.$dataType->slug.'.store') }}"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if($edit)
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            @php
                                $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
                            @endphp
                            <div class="form-group col-md-12">
                            <label class="control-label" for="name">Pizza</label>
                            <input id='pizza-name' type="hidden" name="pizzaname" @if(isset($selectedPizzaName)) value="{{$selectedPizzaName}}" @else value="" @endif>
                            @if(isset($ingrediente))
                            <input id='selected-ingrediente' type="hidden" value='{{json_encode($ingrediente)}}'>
                            @endif
                            <select required id="pizza" name="pizza" class="form-control select2">
                                <option value="">None</option>
                                
                                @foreach($pizzas['products'] as $pizza)
                                @if(isset($selectedPizza))
                                @if($pizza['productId'] == $selectedPizza)
                                <option selected value="{{$pizza['productId']}}" data-ingrediente="{{json_encode($pizza['removableToppings'])}}">{{$pizza['name']}}</option>
                                @else
                                <option value="{{$pizza['productId']}}" data-ingrediente="{{json_encode($pizza['removableToppings'])}}">{{$pizza['name']}}</option>
                                @endif
                                @else
                                <option value="{{$pizza['productId']}}" data-ingrediente="{{json_encode($pizza['removableToppings'])}}">{{$pizza['name']}}</option>
                                @endif
                                @endforeach
                            </select>
                            </div>
                           
                            <div class="form-group col-md-12">
                                <label class="control-label" for="name">Ingrediente blocate</label>
                                <select name="ingrediente[]" id="ingrediente" class="form-control select2" multiple>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="control-label" for="name">Toppinguri blocate</label>
                                <select name="toppings[]" id="toppings" class="form-control select2" multiple>
                                <?php
                                foreach($pizzas['extraToppings'] as $topping){
                                    $found = false;
                                    if($toppings){
                                        foreach($toppings as $produs){
                                            if($topping['productId'] == $produs){
                                                ?>
                                                <option selected value="{{$topping['productId']}}">{{$topping['name']}}</option>
                                                <?php
                                                $found = true;
                                            }
                                        }
                                    }
                                    if($found == false){
                                        ?>
                                        <option value="{{$topping['productId']}}">{{$topping['name']}}</option>
                                        <?php
                                    }
                                }
                                ?>
                                </select>
                            </div>
                            @foreach($dataTypeRows as $row)
                                <!-- GET THE DISPLAY OPTIONS -->
                                
                                @php
                                    $display_options = $row->details->display ?? NULL;
                                    if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                        $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                    }
                                @endphp
                                @if (isset($row->details->legend) && isset($row->details->legend->text))
                                    <legend class="text-{{ $row->details->legend->align ?? 'center' }}" style="background-color: {{ $row->details->legend->bgcolor ?? '#f0f0f0' }};padding: 5px;">{{ $row->details->legend->text }}</legend>
                                @endif

                                <div class="form-group @if($row->type == 'hidden') hidden @endif col-md-{{ $display_options->width ?? 12 }} {{ $errors->has($row->field) ? 'has-error' : '' }}" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                    {{ $row->slugify }}
                                    <label class="control-label" for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>
                                    @include('voyager::multilingual.input-hidden-bread-edit-add')
                                    @if (isset($row->details->view))
                                        @include($row->details->view, ['row' => $row, 'dataType' => $dataType, 'dataTypeContent' => $dataTypeContent, 'content' => $dataTypeContent->{$row->field}, 'action' => ($edit ? 'edit' : 'add'), 'view' => ($edit ? 'edit' : 'add'), 'options' => $row->details])
                                    @elseif ($row->type == 'relationship')
                                        @include('voyager::formfields.relationship', ['options' => $row->details])
                                    @else
                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                    @endif

                                    @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                        {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                    @endforeach
                                    @if ($errors->has($row->field))
                                        @foreach ($errors->get($row->field) as $error)
                                            <span class="help-block">{{ $error }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            @endforeach
                            
                            

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            @section('submit-buttons')
                                <button type="submit" class="btn btn-primary save">{{ __('voyager::generic.save') }}</button>
                            @stop
                            @yield('submit-buttons')
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        $( "#pizza" ).change(function() {
            $('.select2-selection__rendered').empty();
            $("#toppings option:selected").each(function(){
                $(this).removeAttr('selected')
            })
            $('#pizza-name').val($( "#pizza option:selected" ).text())
            var ingrediente = $( "#pizza option:selected" ).data("ingrediente")
            console.log(ingrediente)
            $('#ingrediente').empty();
            var html = ''
            ingrediente.forEach(function (ingredient){
                html+= '<option value="'+ingredient.toppingId+'">'+ingredient.name+'</option>'
            })
            $("#ingrediente").append(html);
        });

        $( "#ingrediente" ).change(function() {
            $( "#ingrediente" ).children('option:selected').each(function (){
                console.log($(this).text())
            })
        })
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            if($('#selected-ingrediente').val()){
                blockedIngrediente = JSON.parse($('#selected-ingrediente').val())
            var ingrediente = $( "#pizza option:selected" ).data("ingrediente")
            $('#ingrediente').empty();
            var html = ''
            ingrediente.forEach(function (ingredient){
                var found = false
                if(blockedIngrediente){
                    blockedIngrediente.forEach(function(blocked){
                        if(blocked == ingredient.toppingId){
                            html+= '<option selected value="'+ingredient.toppingId+'">'+ingredient.name+'</option>'
                            found = true
                        }
                    })
                }
                if(!found)
                html+= '<option value="'+ingredient.toppingId+'">'+ingredient.name+'</option>'
            })
            $("#ingrediente").append(html);
            }else{
                var ingrediente = $( "#pizza option:selected" ).data("ingrediente")
            console.log(ingrediente)
            $('#ingrediente').empty();
            var html = ''
            ingrediente.forEach(function (ingredient){
                html+= '<option value="'+ingredient.toppingId+'">'+ingredient.name+'</option>'
            })
            $("#ingrediente").append(html);
            }
            

            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                } else if (elt.type != 'date') {
                    elt.type = 'text';
                    $(elt).datetimepicker({
                        format: 'L',
                        extraFormats: [ 'YYYY-MM-DD' ]
                    }).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
