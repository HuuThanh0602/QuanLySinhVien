<form action="" method="POST">
    @csrf
    <select name="locale" onchange="this.form.submit()">
        <option value="en"{{ app()->getLocale() == 'en' ? ' selected' : '' }}>English</option>
        <option value="vi"{{ app()->getLocale() == 'vi' ? ' selected' : '' }}>Vietnamese</option>
    </select>
</form>