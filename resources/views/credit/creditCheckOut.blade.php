<x-main-layout>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> الدفع باستخدام البطاقة الائتمانية </div>
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('products.purchase')}}" class="card-form mt-3 mb-3 mx-4">
                        @csrf
                        <input type="hidden" name="payment_method" class="payment-method">
                        <input class="StripeElement mb-3" name="card_holder_name" placeholder="Card holder name" required>
                        <div>
                            <div id="card-element"></div>
                        </div>
                        <div id="card-errors" role="alert"></div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn bg-cart pay">
                                دفع {{$totalPrice}} $ <span class="icon" hidden><i class="fas fa-sync fa-spin"></i></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            let stripe = Stripe("{{ env('STRIPE_KEY') }}")
            let elements = stripe.elements()
            let style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
            let card = elements.create('card', {style: style})
            card.mount('#card-element')
            let paymentMethod = null
            $('.card-form').on('submit', function (e) {
                $('button.pay').attr('disabled', true)
                if (paymentMethod) {
                    return true
                }
                stripe.confirmCardSetup(
                    "{{ $intent->client_secret }}",
                    {
                        payment_method: {
                            card: card,
                            billing_details: {name: $('.card_holder_name').val()}
                        }
                    }
                ).then(function (result) {
                    if (result.error) {
                        $('#card-errors').text(result.error.message)
                        // toastr.error('المعطيات التي قمت بادخالها تحتوي علي اخطاء راجعها مرة اخري ')
                        $('button.pay').removeAttr('disabled')
                    } else {
                        paymentMethod = result.setupIntent.payment_method
                        $('.payment-method').val(paymentMethod)
                        $('.card-form').submit()
                        $('span.icon').removeAttr('hidden');
                        $('button.pay').attr('disabled', true)
                    }
                })
                return false
            })
        </script>

    @endpush
</x-main-layout>
