<tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        <?php echo $guy->getIdUti(); ?>
    </th>
    <td class="px-6 py-4">
        <?php echo $guy->getNomUti(); ?>
    </td>
    <td class="px-6 py-4">
        <?php echo $guy->getPrenomUti(); ?>
    </td>
    <td class="px-6 py-4">
        <?php echo $guy->getMailUti(); ?>
    </td>
    <td class="px-6 py-4">
        <?php 
        if($guy->isAdminUti()) echo "Administrateur";
        else echo "User" 
        ?>
        <!--
        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
        -->
    </td>
</tr>