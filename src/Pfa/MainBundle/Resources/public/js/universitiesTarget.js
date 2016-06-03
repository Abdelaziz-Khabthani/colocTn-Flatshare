function addUniversity(university, index) {
var $container = $('[id ^=pfa_mainbundle_][id $=_targetPreference_universities]');
var $prototype = $($container.attr('data-prototype').replace(/__name__label__/g, '').replace(/__name__/g, index));
$prototype.find('input').val(university);
$container.append($prototype);
}