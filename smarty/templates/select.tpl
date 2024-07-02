<html> 
<body> 
<h2> Codice dei comuni della provincia dell'Aquila </h2>

<br> 
 
<b>Risultati in forma di Select: </b> <br>

<select name="mys">
    {section name=nr loop=$results}
        <option value="{$results[nr]->getCodice()}">
                   {$results[nr]->getComune()} | {$results[nr]->getProvincia()}
        </option>
    {/section}
</select>
 
</body> 
</html> 