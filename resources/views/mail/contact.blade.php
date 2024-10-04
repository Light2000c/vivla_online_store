@component('mail::message')
# New Incoming Message from vivlaviv closet

### Customer Details
- **Name:** {{ $details['name'] }}
- **Email:** {{ $details['email'] }}
- **Subject:** {{ $details['subject'] }}

### Message
{{ $details['message'] }}

---

You can reply directly to the customer at: {{ $details['email'] }}

Thank you for managing this inquiry!

@endcomponent


