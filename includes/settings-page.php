<div class="wrap">
    <h2><?php echo $title; ?></h2>
    <form method="post">
        <?php echo wp_nonce_field( $ns ); ?>
        <table class="form-table">
            <tbody>
            <?php foreach ( $fields as $id => $field ): ?>
                <tr valign="top">
                    <th scope="row"><?php if ( isset( $field['label'] ) ) echo $field['label'] ?></th>
                    <td>
                        <?php switch ( $field['type'] ):
                            case 'text': ?>
                                <input id="<?php echo $id ?>" type="text" name="<?php echo "{$ns}[$id]" ?>" value="<?php echo $values[ $id ]; ?>" size="<?php echo isset( $field['size'] ) ? $field['size'] : 20; ?>" <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?>>
                                <br>
                                <?php break; ?>
                            <?php case 'text group': ?>
                                <fieldset id="<?php echo $id ?>">
                                    <?php foreach ( $field['options'] as $slug => $item ): ?>
                                        <input type="text" name="<?php echo "{$ns}[$id][$slug]" ?>" value="<?php echo isset( $values[ $id ][ $slug ] ) ? $values[ $id ][ $slug ] : ''; ?>" size="<?php echo isset( $field['size'] ) ? $field['size'] : 20; ?>" <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?>> <?php echo $item; ?><br>
                                        <br>
                                    <?php endforeach; ?>
                                </fieldset>
                                <?php break; ?>
                            <?php case 'integer': ?>
                            <?php case 'number': ?>
                                <input id="<?php echo $id ?>" type="number" name="<?php echo "{$ns}[$id]" ?>" value="<?php echo $values[ $id ]; ?>" <?php if ( isset( $field['min'] ) ) {
                                    echo 'min="' . $field['min'] . '"';
                                } ?> <?php if ( isset( $field['max'] ) ) {
                                    echo 'max="' . $field['max'] . '"';
                                } ?> <?php if ( isset( $field['step'] ) ) {
                                    echo 'step="' . $field['step'] . '"';
                                } ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?>>
                                <br>
                                <?php break; ?>
                            <?php case 'integer group': ?>
                            <?php case 'number group': ?>
                                <fieldset id="<?php echo $id ?>">
                                    <?php foreach ( $field['options'] as $slug => $item ): ?>
                                        <input type="number" name="<?php echo "{$ns}[$id][$slug]" ?>" value="<?php echo isset( $values[ $id ][ $slug ] ) ? $values[ $id ][ $slug ] : ''; ?>" size="<?php echo isset( $field['size'] ) ? $field['size'] : 20; ?>" <?php if ( isset( $field['min'] ) ) {
                                            echo 'min="' . $field['min'] . '"';
                                        } ?> <?php if ( isset( $field['max'] ) ) {
                                            echo 'max="' . $field['max'] . '"';
                                        } ?> <?php if ( isset( $field['step'] ) ) {
                                            echo 'step="' . $field['step'] . '"';
                                        } ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?>> <?php echo $item; ?><br>
                                        <br>
                                    <?php endforeach; ?>
                                </fieldset>
                                <?php break; ?>
                            <?php case 'url': ?>
                                <input id="<?php echo $id ?>" type="url" name="<?php echo "{$ns}[$id]" ?>" value="<?php echo $values[ $id ]; ?>" pattern="<?php echo isset( $field['pattern'] ) ? $field['pattern'] : 'https?://.+'; ?>" size="<?php echo isset( $field['size'] ) ? $field['size'] : 20; ?>" <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?>>
                                <br>
                                <?php break; ?>
                            <?php case 'email': ?>
                                <input id="<?php echo $id ?>" type="email" name="<?php echo "{$ns}[$id]" ?>" value="<?php echo $values[ $id ]; ?>" pattern="<?php echo isset( $field['pattern'] ) ? $field['pattern'] : '^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$'; ?>" size="<?php echo isset( $field['size'] ) ? $field['size'] : 20; ?>" <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?>>
                                <br>
                                <?php break; ?>
                            <?php case 'text area': ?>
                                <textarea id="<?php echo $id ?>" name="<?php echo "{$ns}[$id]" ?>" rows="<?php echo isset( $field['rows'] ) ? $field['rows'] : 2; ?>" cols="<?php echo isset( $field['cols'] ) ? $field['cols'] : 20; ?>" <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?>><?php echo $values[ $id ]; ?></textarea>
                                <br>
                                <?php break; ?>
                            <?php case 'checkbox': ?>
                                <input id="<?php echo $id ?>" type="checkbox" name="<?php echo "{$ns}[$id]" ?>" value="1" <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> <?php checked( $values[ $id ] ); ?> <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?>>
                                <?php break; ?>
                            <?php case 'checkbox group': ?>
                                <fieldset id="<?php echo $id ?>">
                                    <?php foreach ( $field['options'] as $value => $item ): ?>
                                        <input type="checkbox" name="<?php echo "{$ns}[$id][$value]" ?>" value="<?php echo $value; ?>" <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> <?php echo isset( $values[ $id ] ) && in_array( $value, $values[ $id ] ) ? 'checked' : '' ?> <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?>> <?php echo $item; ?><br>
                                        <br>
                                    <?php endforeach; ?>
                                </fieldset>
                                <?php break; ?>
                            <?php case 'select': ?>
                                <select id="<?php echo $id ?>" name="<?php echo "{$ns}[$id]" ?>" <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?> >
                                    <?php foreach ( $field['options'] as $value => $item ): ?>
                                        <option value="<?php echo $value; ?>" <?php echo isset( $field['disabled'] ) && in_array( $value, $field['disabled'] ) ? 'disabled' : ''; ?> <?php echo $value == $values[ $id ] ? 'selected' : ''; ?>><?php echo $item; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                                <?php break; ?>
                            <?php case 'select group': ?>
                                <fieldset id="<?php echo $id ?>">
                                    <?php foreach ( $field['options'] as $slug => $item ): ?>
                                        <select name="<?php echo "{$ns}[$id][$slug]" ?>" <?php echo isset( $field['required'] ) && $field['required'] ? 'required' : ''; ?> <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?>>
                                            <?php foreach ( $item['options'] as $value => $name ): ?>
                                                <option value="<?php echo $value; ?>" <?php echo $value == $values[ $id ][ $slug ] ? 'selected' : ''; ?>><?php echo $name; ?></option>
                                            <?php endforeach; ?>
                                        </select> <?php echo $item['label']; ?><br>
                                        <br>
                                    <?php endforeach; ?>
                                </fieldset>
                                <?php break; ?>
                            <?php case 'select multiple': ?>
                                <select multiple id="<?php echo $id ?>" name="<?php echo "{$ns}[$id][]" ?>" <?php echo isset( $field['disabled'] ) && $field['disabled'] ? 'disabled' : ''; ?>>
                                    <?php foreach ( $field['options'] as $value => $item ): ?>
                                        <option value="<?php echo $value; ?>" <?php echo isset( $field['disabled'] ) && in_array( $value, $field['disabled'] ) ? 'disabled' : ''; ?> <?php echo isset( $values[ $id ] ) && in_array( $value, $values[ $id ] ) ? 'selected' : ''; ?>><?php echo $item; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <br>
                                <?php break; ?>
                            <?php case 'html': ?>
                                <div id="<?php echo $id ?>"><?php echo $field['html']; ?></div>
                                <?php break; ?>
                            <?php case 'submit': ?>
                                <?php submit_button( isset( $fields['submit']['text'] ) ? $fields['submit']['text'] : null, isset( $fields['submit']['class'] ) ? $fields['submit']['class'] : 'primary', $id, false, isset( $fields['submit']['disabled'] ) && $fields['submit']['disabled'] ? 'disabled ' : null ); ?>
                            <?php endswitch; ?>
                        <?php if ( isset( $field['description'] ) ): ?>
                            <span class="description"><?php echo $field['description']; ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
</div>
