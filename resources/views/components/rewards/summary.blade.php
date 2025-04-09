@props(['name', 'points', 'spent_points'])

<div class="container"></div>
Hola, {{ $name }}
<div class="flex justify-between max-w-7xl">
   <div>
      icon 
      <div>
        Puntos disponibles
      </div>
      {{ $points }}
   </div>
   <div>
      icon
      Puntos de este semestre
      {{ $spent_points }}
   </div>
</div>
