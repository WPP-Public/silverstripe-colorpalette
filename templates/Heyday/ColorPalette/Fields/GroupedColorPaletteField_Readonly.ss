<% if $SelectedGroup %>
    <h4>$SelectedGroup.XML</h4>
<% end_if %>

<ul  $AttributesHTML>
    <li class="$Class">
        <input name="$Name" type="hidden" value="$InputValue" />
        <label for="$ID" style="background-color: $AttrValue"></label>
    </li>
</ul>
