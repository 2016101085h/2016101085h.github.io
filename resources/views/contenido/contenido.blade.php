@extends('administracion')
@section('contenido')

<template v-if="menu==0">
    <portada></portada>
</template>

<template v-if="menu==1">
    <tipo-plato></tipo-plato>
</template>
<template v-if="menu==2">
    <rol></rol>
</template>
<template v-if="menu==3">
    <entrada></entrada>
</template>
<template v-if="menu==4">
    <sopa></sopa>
</template>
<template v-if="menu==5">
    <bebida></bebida>
</template>
<template v-if="menu==6">
    <platos></platos>
</template>
<template v-if="menu==7">
    <contacto></contacto>
</template>
<template v-if="menu==8">
    <pedidos></pedidos>
</template>
<template v-if="menu==9">
    <usuario></usuario>
</template>
<template v-if="menu==10">
    <calendario></calendario>
</template>
@endsection
