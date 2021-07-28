<select name="unidade" id="munidade" required="required" class="form-control">
    @foreach ($unidade as $un)
    <option value="{{ $uni->unidade }}">{{ $un->unidade }}</option>
    @endforeach
</select>