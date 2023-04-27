@extends('admin.layouts.master')

@section('title', $title)

@push('style')
    <link rel="stylesheet" href="{{asset('admin/css/fileinput.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/vendor-file-upload.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/jquery.fancybox.min.css')}}">
    <link href="{{asset('admin/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
@endpush

@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    <a href="{{route('admin.product.list')}}"><i class="bx bx-home-alt"></i></a>
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                                {{$title}}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <hr/>
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxl-blogger me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">{{$title}}</h5>
                    </div>
                    <hr>
                    @if(!empty($product))
                        <form action="{{route('admin.save.product',[$product->faker_id])}}" id="addEditForm" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <div class="col-8 border-primary border-end">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <input type="file" class="file-input-ajax" id="url" name="image" />
                                </div>
                                @if(!empty($product->image))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="uploaded-img--wrapper row">
                                                <div class="item-img--wrapper">
                                                    <div class="item-img--overlay">
                                                        <div class="container">
                                                            <div class="row overlay-row-room">
                                                                <div class="col-md-6"><a href="#"></a></div>
                                                                <div class="col-md-6 text-right">
                                                                    <a data-fancybox="gallery"
                                                                       href="{{asset('product-images/'.$product->image)}}">
                                                                        <i class="fas fa-image fa-2x" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <img src="{{asset('product-images/'.$product->image)}}" alt="N/A" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5 float-end mx-1">Save</button>
                                <button type="button" class="btn btn-secondary px-5 float-end">Cancel</button>
                            </div>
                        </form>
                    @else
                        <form action="{{route('admin.save.product')}}" id="addEditForm" class="row g-3" enctype="multipart/form-data">
                            @csrf
                            <div class="col-8 border-primary border-end">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="file" class="file-input-ajax" id="url" name="image" />
                                </div>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5 float-end mx-1">Save</button>
                                <button type="button" class="btn btn-secondary px-5 float-end">Cancel</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
            <hr/>
        </div>
    </div>

@endsection

@push('script')
    <script src="{{asset('admin/js/fileinput.min.js')}}"></script>
    <script src="{{asset('admin/js/jquery.fancybox.min.js')}}"></script>
    <script>
        $(function () {
            $('.note-popover').remove();
            let previewZoomButtonClasses = {
                toggleheader: 'btn btn-light btn-icon btn-header-toggle btn-sm',
                fullscreen: 'btn btn-light btn-icon btn-sm',
                borderless: 'btn btn-light btn-icon btn-sm',
                close: 'btn btn-light btn-icon btn-sm'
            };
            // Icons inside zoom modal classes
            let previewZoomButtonIcons = {
                prev: '<i class="icon-arrow-left32"></i>',
                next: '<i class="icon-arrow-right32"></i>',
                toggleheader: '<i class="icon-menu-open"></i>',
                fullscreen: '<i class="icon-screen-full"></i>',
                borderless: '<i class="icon-alignment-unalign"></i>',
                close: '<i class="icon-cross2 font-size-base"></i>'
            };
            $('.file-input-ajax').fileinput({
                browseLabel: 'Browse',
                uploadUrl: $("#upload_path").val(), // server upload action
                uploadExtraData: {
                    '_token': $('input[name="_token"]').val(),
                },
                success: function () {
                },
                uploadAsync: true,
                maxFileCount: 20,
                initialPreview: [],
                dropZoneEnabled: true,
                browseIcon: '<i class="icon-file-plus mr-2"></i>',
                uploadIcon: '<i class="icon-file-upload2 mr-2"></i>',
                removeIcon: '<i class="icon-cross2 font-size-base mr-2"></i>',
                fileActionSettings: {
                    removeIcon: '<i class="icon-bin"></i>',
                    uploadIcon: '<i class="icon-upload"></i>',
                    uploadClass: '',
                    zoomIcon: '<i class="icon-zoomin3"></i>',
                    zoomClass: '',
                    indicatorNew: '<i class="icon-file-plus text-success"></i>',
                    indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
                    indicatorError: '<i class="icon-cross2 text-danger"></i>',
                    indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>',
                },
                layoutTemplates: {
                    icon: '<i class="icon-file-check"></i>',
                },
                initialCaption: 'Browse your file*',
                previewZoomButtonClasses: previewZoomButtonClasses,
                previewZoomButtonIcons: previewZoomButtonIcons
            });

            $('.file-input-ajax').on('fileuploaded', function (event, data, previewId, index) {
                let form = data.form, files = data.files, extra = data.extra,
                    response = data.response, reader = data.reader;
                if (response.hasOwnProperty("success")) {
                    imgfiles = data.filescount;
                    if(++index == files.length) {
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                }
            });

            $('input[class="file-caption-name"]').attr('readonly',true);

            /*Blog form Save */
            $('#addEditForm').on('submit', function (e) {
                $(this).find('#submit').attr('disabled', true);
                $(':input').removeClass('has-error');
                $('.text-danger').remove();
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        alertyFy(res.msg, res.status, 2000);
                        if (res.status == 'success') {
                            setTimeout(function () {
                                location.href = "{{route('admin.product.list')}}";
                            },2500);
                        }
                    },
                    error: function (request, status, error) {
                        if (request.status===422) {
                            $.each(request.responseJSON.errors, function (k, v) {
                                $(`:input[name="${k}"]`).addClass("has-error");
                                if (k=='image') {
                                    $(`:input[name="${k}"]`).parent().parent().parent().before(`<p class="text-danger">${v[0]}</p>`);
                                } else {
                                    $(`:input[name="${k}"]`).after(`<span class="text-danger">${v[0]}</span>`);
                                }
                            });
                        } else {
                            console.log('error', request.responseText);
                            alertyFy('There is something wrong*', 'warning', 2000);
                        }
                        $(this).find('#submit').removeAttr('disabled');
                    }
                });
            });

        });
        $(document).on("click", function(event){
            $('.fileinput-upload').remove();
            $('.fileinput-cancel').remove();
        });
    </script>
@endpush
