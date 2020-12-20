<div>
    {!! Field::text('name',$name,['label'=>__('admin.NOMBRE'),'required'=>true]) !!}
    {!! Field::textarea('description',$description,['label'=>__('admin.DESCRIPCION'),'required'=>true]) !!}
    {!! Field::file('photo',['label'=>__('admin.PHOTO')]) !!}
</div>
