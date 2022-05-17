@if ($errors->any())
    <?php
    echo json_encode(['error' => $errors->all()]);
    ?>
@else
    <?php
    echo json_encode(['error' => [html_entity_decode(Session::get('error'))]]);
    ?>
@endif
