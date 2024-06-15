@extends('admin.layouts.admin')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-header">Открытый чек</div>

                <div class="card-body">
                    @if($cart)
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Наименование</th>
                                <th scope="col">Цена</th>
                                <th scope="col">Кол-во</th>
                                <th scope="col">Сумма</th>
                                <th scope="col">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cart as $item)
                                <tr>
                                    <th scope="row">{{ $item['product_id'] }}</th>
                                    <td>
                                        {{ $item['name'] }}
                                    </td>
                                    <td>{{ $item['price'] }} грн</td>
                                    <td>{{ $item['quantity'] }}</td>
                                    <td>{{ $item['price'] * $item['quantity'] }} грн</td>
                                    <td>
                                        <form action="{{ route('cart.remove', $item['product_id']) }}"
                                              method="POST">
                                            <button class="btn btn-block bg-gradient-danger btn-sm">Удалить 1
                                                шт.
                                            </button>
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><h4>Итого:</h4></td>
                                <td><h4>{{ $total }} грн</h4></td>
                                <td></td>


                            </tr>
                            </tbody>

                        </table>
                        <div class="d-flex justify-content-between row">
                            <div class="col-4">
                                <button type="button" class="btn btn-block bg-gradient-danger btn-sm"
                                        style="width: 200px"
                                        data-toggle="modal"
                                        data-target="#exampleModal">
                                    Очистить все
                                </button>
                            </div>
                            <div class="col-4">

                                <button type="button" class="btn btn-block bg-gradient-success btn-sm ms-3"
                                        data-toggle="modal"
                                        data-target="#staticBackdrop">
                                    Расчет
                                </button>
                            </div>
                        </div>
                    @else
                        <h4>Добавте товар в чек</h4>
                    @endif


                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->


    <!-- Modal Clear -->
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Подтверждение</h1>
                </div>
                <div class="modal-body">
                    Очистка удалит весь товар из чека. Вы уверены?
                </div>
                <div class="modal-footer">

                    @if(is_object($cart))
                        <form action="{{ route('cart.clear') }}" method="POST">

                            @csrf
                            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Отмена
                            </button>
                            <input type="hidden" name="check_id" value="{{ $idCheck }}">
                            <button class="btn btn-danger" type="submit">Очистить корзину</button>
                        </form>
                    @else
                        <form action="{{ route('cart.clear') }}" method="POST">

                            @csrf
                            <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">Отмена
                            </button>

                            <button class="btn btn-danger" type="submit">Очистить корзину</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Калькулятор сдачи</h1>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="icheck-success d-inline">
                                <input type="radio" name="payment_method" id="cash" checked
                                       value="{{ \App\Models\Order::PAYMENT_METHOD_CASH }}">
                                <label for="cash">Оплата наличными</label>
                            </div>

                            <div class="icheck-success d-inline">
                                <input type="radio" name="payment_method" id="bank"
                                       value="{{ \App\Models\Order::PAYMENT_METHOD_BANK }}">
                                <label for="bank">Оплата банковской картой</label>
                            </div>

                            <div id="change-calc">
                                <div class="form-group mt-4">
                                    <label for="purchase-amount">Сумма покупки:</label>
                                    <input type="number" class="form-control" id="purchase-amount" value="{{ $total }}"
                                           readonly>
                                </div>

                                <div class="form-group">
                                    <label for="payment-amount">Сумма клиента:</label>
                                    <input type="number" class="form-control" id="payment-amount" step="0.01"
                                           oninput="calculateChange()">
                                </div>

                                <div class="form-group">
                                    <label for="change-amount">Сдача:</label>
                                    <input type="text" class="form-control" id="change-amount" readonly>
                                </div>
                            </div>

                            <input type="email" class="form-control mt-4" name="email" placeholder="Email для получения чека">

                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">

                        <button class="btn btn-success mt-3 col-12" type="submit">Оплатить</button>
                        <button type="button" class="btn btn-secondary col-12 mt-3" data-dismiss="modal">Отмена</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function calculateChange() {
            var purchaseAmount = parseFloat(document.getElementById('purchase-amount').value);
            var paymentAmount = parseFloat(document.getElementById('payment-amount').value);
            var changeAmount = paymentAmount - purchaseAmount;

            if (isNaN(changeAmount)) {
                changeAmount = 0;
            }

            document.getElementById('change-amount').value = changeAmount.toFixed(2);
        }

        $(document).ready(function() {
            $('#cash').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#change-calc').show();
                } else {
                    $('#change-calc').hide();
                }
            });

            $('#bank').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#change-calc').hide();
                }
            });
        });

    </script>

@endsection
