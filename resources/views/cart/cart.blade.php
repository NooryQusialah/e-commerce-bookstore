<x-main-layout>
    <div class="row justify-content-center mt-2 ml-2 pr-2 ">
        @if(session('message'))
            <div class="col-md-8 text-center h3 p-4 bg-success text-light rounded"> تمت عملية الشراء بنجاح</div>
        @endif
        <div class="col-md-12">
            <div class="card ml-2 mr-2">
                <div class="card-title text-center mb-1 text-muted fw-bold">
                    عربة التسوق
                </div>
                <div class="card-body">
                    @if($allBooksInCart->count())
                        @php($totalPrice=0)
                        @foreach($allBooksInCart as $book)
                            @php($totalPrice+= $book->price * $book->pivot->numberOfCopies)
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap mt-1">
                                    <div class="w-100 ">
                                        <div class="d-flex justify-content-between ">
                                            <div>
                                                <h5 class="mb-1">عنوان الكتاب:  {{$book->title}} </h5>
                                                <p class="mb-1 text-muted">سعر الكتاب : {{$book->price}}$</p>
                                                <p class="mb-1 text-muted">الكمية: {{$book->pivot->numberOfCopies}}</p>
                                                <p class="mb-1 text-muted fw-bold">الإجمالي: {{$book->price * $book->pivot->numberOfCopies}}$</p>
                                            </div>
                                            <div class="d-flex flex-column gap-2">
                                                <form action="{{route('removeOneCart',$book->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-warning btn-sm">حذف نسخة واحدة</button>
                                                </form>
                                                <form action="{{route('removeAllCart',$book->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm">حذف الكل</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endforeach
                        <div class="text-center mt-1">
                            <h4 class="mb-1 mt-1 text-muted fw-bold">اجمالي المبلغ كامل :   {{$totalPrice}} $</h4>

                        </div>

                    <div class="row justify-content-center ">
                        <a href="{{route('creditCheckOut')}}" class="d-inline-block mb-4 float-start btn bg-cart" style="text-decoration: none">
                            <span>بطاقة ائتمانية</span>
                            <i class="fas fa-credit-card"></i>
                        </a>
                    </div>
{{--                        <div class="d-inline-block align-items-center text-center" id="paypal-button-container"></div>--}}
{{--                        <p id="result-message"></p>--}}



                    @else
                        <div class="alert alert-info text-center">
                            لايوجد كتب في السلة
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('scripts')

        <script
{{--            here it must add the id of the clinet --}}
            src="https://www.paypal.com/sdk/js?client-id=test&buyer-country=US&currency=USD&components=buttons&enable-funding=venmo,paylater,card"
            data-sdk-integration-source="developer-studio"
        ></script>
        <script !src="">
            const paypalButtons = window.paypal.Buttons({
                style: {
                    shape: "rect",
                    layout: "vertical",
                    color: "gold",
                    label: "paypal",
                },
                message: {
                    amount: 100,
                },
                async createOrder() {
                    try {
                        const response = await fetch("/api/orders", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            // use the "body" param to optionally pass additional order information
                            // like product ids and quantities
                            body: JSON.stringify({
                                cart: [
                                    {
                                        id: "YOUR_PRODUCT_ID",
                                        quantity: "YOUR_PRODUCT_QUANTITY",
                                    },
                                ],
                            }),
                        });

                        const orderData = await response.json();

                        if (orderData.id) {
                            return orderData.id;
                        }
                        const errorDetail = orderData?.details?.[0];
                        const errorMessage = errorDetail
                            ? `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})`
                            : JSON.stringify(orderData);

                        throw new Error(errorMessage);
                    } catch (error) {
                        console.error(error);
                        // resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
                    }
                },
                async onApprove(data, actions) {
                    try {
                        const response = await fetch(
                            `/api/orders/${data.orderID}/capture`,
                            {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                },
                            }
                        );

                        const orderData = await response.json();
                        // Three cases to handle:
                        //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                        //   (2) Other non-recoverable errors -> Show a failure message
                        //   (3) Successful transaction -> Show confirmation or thank you message

                        const errorDetail = orderData?.details?.[0];

                        if (errorDetail?.issue === "INSTRUMENT_DECLINED") {
                            // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                            // recoverable state, per
                            // https://developer.paypal.com/docs/checkout/standard/customize/handle-funding-failures/
                            return actions.restart();
                        } else if (errorDetail) {
                            // (2) Other non-recoverable errors -> Show a failure message
                            throw new Error(
                                `${errorDetail.description} (${orderData.debug_id})`
                            );
                        } else if (!orderData.purchase_units) {
                            throw new Error(JSON.stringify(orderData));
                        } else {
                            // (3) Successful transaction -> Show confirmation or thank you message
                            // Or go to another URL:  actions.redirect('thank_you.html');
                            const transaction =
                                orderData?.purchase_units?.[0]?.payments?.captures?.[0] ||
                                orderData?.purchase_units?.[0]?.payments
                                    ?.authorizations?.[0];
                            resultMessage(
                                `Transaction ${transaction.status}: ${transaction.id}<br>
          <br>See console for all available details`
                            );
                            console.log(
                                "Capture result",
                                orderData,
                                JSON.stringify(orderData, null, 2)
                            );
                        }
                    } catch (error) {
                        console.error(error);
                        resultMessage(
                            `Sorry, your transaction could not be processed...<br><br>${error}`
                        );
                    }
                },


            });
            paypalButtons.render("#paypal-button-container");


            // Example function to show a result to the user. Your site's UI library can be used instead.
            function resultMessage(message) {
                const container = document.querySelector("#result-message");
                container.innerHTML = message;
            }
        </script>
    @endpush
</x-main-layout>
