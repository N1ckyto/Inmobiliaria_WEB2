## TPE 2024 - Primera parte - Dominio
## Consigna

Se propone diseñar una base de datos que pueda almacenar un conjunto de elementos
clasificados en categorías o un conjunto de elementos con un subconjunto de
detalles. Esta base de datos será luego expuesta y administrada vía web.

## Dominio 
· Las entidades "propietarios" e "inquilinos" tiene una relación de 1 a N con "agentes", ya que ambos pueden tener un agente asignado y un agente puede tener distintos inquilinos
u/o propietarios.

· La entidad "propiedad" tiene como clave primaria "id" y como clave foranea "id_propietario"
