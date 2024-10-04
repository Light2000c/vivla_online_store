@component('mail::message')
    # New Order Confirmation - Vivlaviv Closet

    ### Order Details
    - **Order Number:** {{ $details['order_number'] }}
    - **Order Date:** {{ $details['order_date'] }}

    Dear {{ $details['name'] }},

    Thank you for shopping with Vivlaviv Closet! We are thrilled to confirm your order. Our team is processing it, and you
    will receive an update once it's ready for shipping.

    If you have any questions about your order, feel free to reach out to our support team at mailto:support@vivlavivcloset.com.


    ---

    Thank you for choosing Vivlaviv Closet!
@endcomponent
