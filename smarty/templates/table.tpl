<html> 
<body> 
<h2> Codice dei comuni  </h2>

<br>

<b>Risultati in forma di Table:</b> <br>

<table cellpadding=1 cellspacing=0 border=0 width=60%>
{section name=nr loop=$results} 
    <tr {if $smarty.section.nr.iteration is odd} bgcolor="#ccc" {/if}>
        <td> 
             {$smarty.section.nr.iteration}
	</td>
	<td>
             {$results[nr]->getCodice()}
	</td>
        <td> 
             {$results[nr]->getComune()}
	</td>
        <td> 
             {$results[nr]->getProvincia()}
	</td> 
    </tr> 
 
{sectionelse} 
   <tr>
        <td align="center">
	    <b> nessun risultato </b>
	<td>
   </tr>
{/section} 
     
</table>
 
</body> 
</html> 