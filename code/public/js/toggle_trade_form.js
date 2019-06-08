dom_ready(function() {
    if (!document.getElementById('trade_create_form')) {
        return;
    }
    
    document.getElementById('hat-group').style.display = 'none';
    document.getElementById('charm-group').style.display = 'none';

    document.getElementById('charm').addEventListener('click', function() {
        document.getElementById('hat-group').style.display = 'none';
        document.getElementById('charm-group').style.display = 'block';
    });
    document.getElementById('hat').addEventListener('click', function() {
        document.getElementById('hat-group').style.display = 'block';
        document.getElementById('charm-group').style.display = 'none';
    });
});