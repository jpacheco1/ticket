<div style="font-family: Arial, sans-serif; line-height: 1.5; color: #333;">
    <h1>Inscripción recibida</h1>
    <p>Hola {{ $inscription->name }},</p>

    <p>Tu inscripción ha sido exitosa. Tus datos son:</p>

    <ul>
        <li><strong>Distrito:</strong> {{ $inscription->district_id }}</li>
        <li><strong>Nombre:</strong> {{ $inscription->name }}</li>
        <li><strong>Identificación:</strong> {{ $inscription->nid }}</li>
        <li><strong>Teléfono:</strong> {{ $inscription->cellphone }}</li>
        <li><strong>Correo:</strong> {{ $inscription->email }}</li>
    </ul>

    <p>Aquí encontraras el ticket de acceso al evento:</p>

    <a href="{{ route('inscriptions.ticket', ['id' => ($inscription->id.'-'.$inscription->event_id.'-'.$inscription->nid)]) }}"
        style="display: inline-block; padding: 10px 20px; background-color: #007BFF; color: #fff; text-decoration: none; border-radius: 5px;"
    >
        Descargar Ticket
    </a>

    <p>Saludos,<br>El equipo de Educación Cristiana IPUC</p>
</div>
