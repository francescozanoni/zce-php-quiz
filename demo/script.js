window.onerror = function (e) {
    alert(e);
};

function renderItem(item) {

    var renderedItem = document.createElement('li');

    var questionText = document.createTextNode(item.getElementsByTagName('question').item(0).textContent.trim());
    var question = document.createElement('span');
    question.appendChild(questionText);
    renderedItem.appendChild(question);

    if (item.getElementsByTagName('code').length === 1) {
        var codeText = document.createTextNode(item.getElementsByTagName('code').item(0).textContent.trim().replace(/\n\s+/g, '\n'));
        var code = document.createElement('pre');
        code.appendChild(codeText);
        renderedItem.appendChild(code);
    }

    var answers = document.createElement('ul');
    for (var i = 0; i < item.getElementsByTagName('answer').length; i++) {
        var answerCheckbox = document.createElement('input');
        answerCheckbox.setAttribute('type', 'checkbox');
        answerCheckbox.setAttribute('value', item.getElementsByTagName('answer').item(i).textContent.trim());
        if (item.getElementsByTagName('answer').item(i).hasAttribute('correct') === true) {
            answerCheckbox.setAttribute('data-correct', 'correct');
        }
        var answerText = document.createTextNode(item.getElementsByTagName('answer').item(i).textContent.trim());
        var answer = document.createElement('li');
        answer.appendChild(answerCheckbox);
        answer.appendChild(answerText);
        answers.appendChild(answer);
    }
    renderedItem.appendChild(answers);

    // @todo add hidden theory tag
    // @todo add hidden reference tag

    return renderedItem;
}

function reqListener() {
    var currentItems = this.responseXML.getElementsByTagName('item');
    if (currentItems.length > 0) {
        for (var i = 0; i < currentItems.length; i++) {
            document.getElementById('container').appendChild(renderItem(currentItems.item(i)));
        }
    }
}

var fileBasePath = '../src';

var filePaths = [
    'arrays/array_functions.xml',
    'arrays/array_iteration.xml',
    'arrays/associative_arrays.xml',
    'arrays/casting.xml',
    'arrays/spl_objects_as_arrays.xml',
    'data_format_and_types/datetime.xml',
    'data_format_and_types/domdocument.xml',
    'data_format_and_types/json.xml',
    'data_format_and_types/simplexml.xml',
    'data_format_and_types/soap.xml',
    'data_format_and_types/webservices_basics.xml',
    'data_format_and_types/xml_basics.xml',
    'data_format_and_types/xml_extension.xml',
    'databases_and_sql/joins.xml',
    'databases_and_sql/pdo.xml',
    'databases_and_sql/prepared_statements.xml',
    'databases_and_sql/sql.xml',
    'databases_and_sql/transactions.xml',
    'error_handling/errors.xml',
    'error_handling/handling_exceptions.xml',
    'error_handling/throwables.xml',
    'functions/anonymous_functions_closures.xml',
    'functions/arguments.xml',
    'functions/config.xml',
    'functions/references.xml',
    'functions/returns.xml',
    'functions/type_declarations.xml',
    'functions/variable_scope.xml',
    'functions/variables.xml',
    'i_o/contexts.xml',
    'i_o/file_system_functions.xml',
    'i_o/files.xml',
    'i_o/reading.xml',
    'i_o/streams.xml',
    'i_o/writing.xml',
    'object_oriented_programming/autoload.xml',
    'object_oriented_programming/class_constants.xml',
    'object_oriented_programming/instance_methods_and_properties.xml',
    'object_oriented_programming/instantiation.xml',
    'object_oriented_programming/interfaces.xml',
    'object_oriented_programming/late_static_binding.xml',
    'object_oriented_programming/magic_methods.xml',
    'object_oriented_programming/modifiers_inheritance.xml',
    'object_oriented_programming/reflection.xml',
    'object_oriented_programming/return_types.xml',
    'object_oriented_programming/spl.xml',
    'object_oriented_programming/traits.xml',
    'object_oriented_programming/type_hinting.xml',
    'php_basics/config.xml',
    'php_basics/control_structures.xml',
    'php_basics/extensions.xml',
    'php_basics/language_constructs_and_functions.xml',
    'php_basics/namespaces.xml',
    'php_basics/operators.xml',
    'php_basics/performance_bytecode_caching.xml',
    'php_basics/syntax.xml',
    'php_basics/variables.xml',
    'security/configuration.xml',
    'security/cross_site_request_forgeries.xml',
    'security/cross_site_scripting.xml',
    'security/email_injection.xml',
    'security/encryption_hashing_algorithms.xml',
    'security/escape_output.xml',
    'security/file_uploads.xml',
    'security/filter_input.xml',
    'security/password_hashing_api.xml',
    'security/php_configuration.xml',
    'security/remote_code_injection.xml',
    'security/session_security.xml',
    'security/sql_injection.xml',
    'strings_and_patterns/encodings.xml',
    'strings_and_patterns/extracting.xml',
    'strings_and_patterns/formatting.xml',
    'strings_and_patterns/matching.xml',
    'strings_and_patterns/nowdoc.xml',
    'strings_and_patterns/pcre.xml',
    'strings_and_patterns/quoting.xml',
    'strings_and_patterns/replacing.xml',
    'strings_and_patterns/searching.xml',
    'web_features/cookies.xml',
    'web_features/forms.xml',
    'web_features/get_and_post_data.xml',
    'web_features/http_authentication.xml',
    'web_features/http_headers.xml',
    'web_features/http_status_codes.xml',
    'web_features/sessions.xml'
];

for (var i = 0; i < filePaths.length; i++) {
    var oReq = new XMLHttpRequest();
    oReq.addEventListener('load', reqListener);
    oReq.open('GET', fileBasePath + '/' + filePaths[i]);
    oReq.send();
}
