<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Finalizare Comandă</h1>

        <div class="bg-white shadow-md rounded-lg overflow-hidden mb-4 p-6">
            <h2 class="text-lg font-semibold mb-4">Detalii Plată</h2>

            <form id="payment-form" class="space-y-4">
                <div id="card-element" class="p-3 bg-gray-100 rounded-md"></div>
                <div id="card-errors" role="alert" class="text-red-500"></div>
                <button id="submit-button" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4 transition duration-300 ease-in-out">
                    Confirmă Comanda
                </button>
            </form>
        </div>
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            const stripe = Stripe('pk_test_51HSHEDHXupmPYY82tB7pMN7BJirx3u2HT5oWXoXjs5FgaMO6Xmzld3pqe8Mkts06Y7SyWlcpeVKmwWhcu26OTVlo001bth8MH3');
            var elements = stripe.elements();

            var style = {
                base: {
                    color: "#32325d",
                }
            };

            var card = elements.create("card", { style: style });
            card.mount("#card-element");

            card.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            var form = document.getElementById('payment-form');

            form.addEventListener('submit', function(ev) {
            ev.preventDefault(); // Previne submit-ul implicit al formularului

            stripe.confirmCardPayment('{{ $clientSecret }}', {
                payment_method: {
                    card: card,
                }
            }).then(function(result) {
                if (result.error) {
                    // Arată eroarea în interfața utilizatorului
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    if (result.paymentIntent.status === 'succeeded') {
                        // Trimitere request către server pentru a confirma plata și a goli coșul
                        fetch('/confirm-checkout', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Asigurați-vă că aveți un meta tag CSRF
                            },
                            body: JSON.stringify({ paymentIntentId: result.paymentIntent.id })
                        })
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data.status === 'success') {
                                window.location.href = '/cart/confirmation';
                            } else {
                                // Gestionarea cazului în care răspunsul nu este succes
                                console.error('Payment confirmation failed');
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                        });

                    }
                }
            });
        });


        </script>
    </div>
</x-app-layout>
