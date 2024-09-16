# TPE 2024 - Primera parte - Dominio
## Consigna

Se propone diseñar una base de datos que pueda almacenar un conjunto de elementos
clasificados en categorías o un conjunto de elementos con un subconjunto de
detalles. Esta base de datos será luego expuesta y administrada vía web.


# Inmobiliaria
## Tablas
1. **`agentes`**  
   Contiene información sobre agentes inmobiliarios, identificados por `id`.

2. **`inquilinos`**  
   Registra inquilinos y está vinculado a `agentes` a través del campo `id_agente`.

3. **`propietarios`**  
   Contiene propietarios de propiedades y está relacionado con `agentes` mediante `id_agente`.

4. **`propiedades`**  
   Describe las propiedades, asociadas a `propietarios` con `id_propietario` y se actualizan automáticamente si el `id` de `propietario` cambia.
   
![](https://github.com/N1ckyto/Inmobiliaria_WEB2/blob/main/Inmobiliria_db.png)

# Estudiantes
Escudero Nicolas - Barberia Facundo
