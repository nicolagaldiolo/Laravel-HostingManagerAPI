<li class="m-nav__item">
    <a href="{{route('manage-renewals.sendReminder', $service->customer)}}" class="m-nav__link sendCustomerReminder">
        <i class="m-nav__link-icon flaticon-alarm-1"></i>
        <span class="m-nav__link-text">{{__('messages.customer_send_manual_reminder')}}</span>
    </a>
</li>
