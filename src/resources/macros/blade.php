<?php

Blade::directive('error', function ($expression) {
    return "<?php echo \$errors->first($expression, '<span class=\"help-block\">:message</span>'); ?>";
});

Blade::directive('adminFormGroup', function ($expression) {
    return "<div class=\"form-group<?php echo \$errors->has($expression) ? ' has-error' : '' ?>\">";
});

Blade::directive('endFormGroup', function ($expression) {
    return '</div>';
});
