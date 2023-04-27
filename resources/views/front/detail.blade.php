@extends('front.layouts.master')
@section('title', 'Shop')

@push('style')
    <style>
        #overlay {
            position: fixed;
            display: none;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.3);
            z-index: 99999999999;
        }
        #overlay .meimg{
            width: 150px;
            height: 150px;
            display: block;
            margin: 0 auto;
            margin-top: calc(100vh - 60vh);
            object-fit: cover;
        }
        .has-error {
            border: 1px solid red!important;
        }
        .swal2-popup {
            width: auto!important;
        }
        .swal2-modal .swal2-title {
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    <div id="overlay"><img class="meimg" src={{asset('assets/images/statusloading.gif')}} width="100" height="100" /></div>
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{asset('product-images/'.$product->image)}}" alt="{{$product->name}}" /></div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{$product->name}}</h1>
                    <div class="fs-5 mb-5">
                        <span>${{$product->price}}</span>
                    </div>
                    <div class="d-flex">
                        <button onclick="showModal()" class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Buy
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button onclick="closeModal()" type="button" class="close" >&times;</button>
                    <h4 class="modal-title">Payment Form</h4>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="card_number">Card Number</label>
                            <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Card Number">
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="card_cvc">Card CVC</label>
                            <input type="text" class="form-control" id="card_cvc" name="card_cvc" placeholder="Card CVC">
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="expiry_month">Month</label>
                                <select class="form-control" id="expiry_month" name="expiry_month">
                                    <option value="01">January</option>
                                    <option value="02">February </option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="expiry_year">Year</label>
                                <select class="form-control" id="expiry_year" name="expiry_year">
                                    <option value="{{date('y')}}">
                                        {{date('Y')}}
                                    </option>
                                    @for($i = 1; $i < 10; $i++)
                                        <option value="{{date('y',strtotime('+'.$i.' year'))}}">
                                            {{date('Y',strtotime('+'.$i.' year'))}}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button onclick="closeModal()" type="button" class="btn btn-danger">Close</button>
                    <button onclick="buyProduct()" type="button" class="btn btn-primary">Buy</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        function showModal() {
            $('#paymentModal').modal('show');
        }
        function closeModal() {
            $('#paymentModal').modal('hide');
        }
        function buyProduct(input) {
            $(input).attr('disabled',true)
            $(':input').removeClass('has-error');
            $('.text-danger').remove();
            document.getElementById("overlay").style.display = "block";
            axios.post('{{route('product.buy',[$product->faker_id])}}', $('form#paymentForm').serialize()).then(function (response) {
                if (response.data.status === 'success') {
                    alertyFy(response.data.msg,response.data.status);
                    closeModal();
                } else {
                    alertyFy(response.data.msg,response.data.status);
                }
                $(input).attr('disabled',false)
                document.getElementById("overlay").style.display = "none";
            }).catch(function (error) {
                if(error.response.status == 422) {
                    $.each(error.response.data.errors, function (k, v) {
                        $(`:input[name="${k}"]`).addClass("has-error");
                        $(`:input[name="${k}"]`).after(`<span class="text-danger">${v[0]}</span>`);
                    });
                } else {
                    alertyFy('There is something wrong*','warning');
                }
                $(input).attr('disabled',false)
                document.getElementById("overlay").style.display = "none";
            });
        }
    </script>
@endpush
