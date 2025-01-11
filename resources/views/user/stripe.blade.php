<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<div class="container">
    <h3 class="text-center m-5">Payment By Card</h3>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table">
                    <h3 class="panel-title">Payment Details</h3>
                </div>
                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif

                    <form id="payment-form">
                        @csrf
                        <div id="card-element" class="form-control">
                            <!-- Stripe Elements will inject the card input here -->
                        </div>
                        <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        <br>
                        <button id="submit" class="btn btn-primary btn-lg btn-block">Pay Now (${{ $totalPrice }})</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const stripe = Stripe('{{ env("STRIPE_KEY") }}');
    const elements = stripe.elements();
    const style = {
        base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4",
            }
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a",
        },
    };
    const card = elements.create('card', { style });
    card.mount('#card-element');

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const { clientSecret } = await fetch('/stripe/create-payment-intent', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ amount: {{ $totalPrice * 100 }} }),
        }).then((res) => res.json());

        const { error, paymentIntent } = await stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: card,
            },
        });

        if (error) {
            const errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
        } else if (paymentIntent.status === 'succeeded') {
            alert('Payment Successful!');
            form.submit();
        }
    });
</script>
</body>
</html>
