{use class="yii\helpers\Html"}
<h1>
    All books
    {if $titulo <= 0}
        <span style="color: red;">No hay libros</span>
    {else}
        <span style="color: green;">Hay muchos libros</span>
    {/if}
</h1>

<table>
    <thead style="background-color: #ddd; font-weight: bold;">
        <tr>
            <th>
                Title
            </th>
        </tr>
    </thead>
    <tbody>
        {foreach $books as $book}
        <tr>
            <td>
                {Html::a($book->toString(), ['book/detail', 'id' => $book->getId()])}
            </td>
        </tr>
        {/foreach}
    </tbody>
</table>