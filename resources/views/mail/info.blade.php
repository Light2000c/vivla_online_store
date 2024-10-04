@component('mail::message')
# New Order Notification - Vivlaviv Closet

### Order Details
- **Order Number:** {{ $details['order_number'] }}
- **Customer Name:** {{ $details['name'] }}
- **Customer Email:** {{ $details['email'] }}
- **Order Date:** {{ $details['order_date'] }}

A new order has been placed by {{ $details['name'] }} on Vivlaviv Closet. Please review the order and prepare it for processing.

You can view and manage the order in the admin dashboard.

If you have any issues or need further clarification, please contact our support team.

---

Thank you,<br>
Vivlaviv Closet Admin Team
@endcomponent
