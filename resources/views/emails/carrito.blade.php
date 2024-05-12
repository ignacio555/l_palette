<x-mail::message>
# L_palete - Productos en tu carrito

¡Hola {{$datos['user']->name}}!

Aquí tienes un resumen de los productos que has agregado al carrito:


- **{{ $datos['producto']->nombre }}**
  - Descripcion: {{$datos['producto']->descripcion}}
  - Precio: ${{ $datos['producto']->precio }}
  - Cantidad: {{ $datos['cantidad'] }}



Gracias por tu compra.

Atentamente,
{{ config('app.name') }}
</x-mail::message>