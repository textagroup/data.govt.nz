$Content
$ContactSearchForm
<% if $contactList %>
    <div class="row">
        <% loop $contactList %>
            <div class="col-md-12"><a href = "$Up.ContactFormLink?ID=$ID">$Name</a></div>
        <% end_loop %>
    </div>
<% end_if %>
