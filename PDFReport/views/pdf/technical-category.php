<?php 
    $this->layout = 'nolayout'; 
    $sub = $app->view->jsObject['subscribers'];
    $nameOpportunity = $sub[0]->opportunity->name;
    $opp = $app->view->jsObject['opp'];
?>

<div class="container">
    <?php 
    foreach ($opp->registrationCategories as $key => $nameCat) :?>
        <table class="table table-striped">
            <thead>
                <tr class="activeTr">
                    <th colspan="4">
                        <?php echo $nameCat; ?>
                    </th>
                </tr>
                <tr style="background-color: #009353; color:white">
                    <th style="width: 10%" class="text-center">Classificação</th>
                    <th class="space-tbody-15">Inscrição</th>
                    <th>Nome</th>
                    <?php 
                    if($preliminary) :
                    ?>
                    <th class="text-center space-tbody-10">Nota</th>
                    <?php 
                    endif;
                    
                    if($preliminary == false) :
                    ?>
                    <th class="text-center space-tbody-10">Nota Def.</th>
                    <?php 
                    endif;
                    ?>
                </tr>
            </thead>
            <tbody>
            <?php 
                $isExist = false;
                $classification = 0;
                //LOOP NOS CANDIDATOS
                foreach ($sub as $key => $nameSub):
                    //SE AS CATEGORIAS FOREM IGUAIS, IMPRIME AS INFORMAÇÕES
                    if($nameCat == $nameSub->category):?>
                    <tr>
                        <td style="width: 10%" class="text-center">
                        <?php 
                        //A CADA LOOP A CLASSIFICAÇÃO RECEBE, ELE MESMO +1
                            $classification = ($classification + 1);
                            echo $classification;
                        ?>
                        <td class="space-tbody-15"><?php echo $nameSub->number; ?></td>
                        <td><?php echo $nameSub->owner->name; ?></td>
                        <td class="text-center space-tbody-10">
                            <?php 
                                if($preliminary){
                                    echo $nameSub->preliminaryResult;
                                }else{
                                    echo $nameSub->consolidatedResult;
                                }; 
                            ?>
                        </td>
                    </tr>
                <?php
                //EXCLUINDO O INDICE DO ARRAY PARA O PROXIMO LOOP
                unset($sub[$key]);
                    endif;
                    //SE NÃO EXISTIR REGISTRO NO INDICE DO ARRAY ENTÃO ALTERA PARA TRUE
                    if(!isset($nameSub->id)):
                        $isExist = true;
                    endif;
                endforeach;
                //SE FOR FALSO - IMPRIME A INFORMAÇÃO
                if(!$isExist) :?>
                    <tr>
                        <td colspan="4"><?php \MapasCulturais\i::_e("Não houve candidato selecionado nessa categoria");?></td>
                    </tr>
            <?php    
                endif;
            ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>
<?php 
    //die;
?>
