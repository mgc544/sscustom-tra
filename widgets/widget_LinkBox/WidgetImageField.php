<?php
class WidgetImageField extends FormField {
	function Field() {
		$html = "<div class=\"mysimpleimage\">";

		if($this->value != 0) {
			$doImage = DataObject::get_by_id('Image',$this->value);

			$html .= '<div class="thumbnail">';
			if ($doImage) {
				if($doImage->hasMethod('Thumbnail') && $doImage->Thumbnail()) {
					$html .= "<img src=\"".$doImage->Thumbnail()->getURL()."\" />";
				}
				else if($doImage->CMSThumbnail()) {
					$html .= "<img src=\"".$doImage->CMSThumbnail()->getURL()."\" />";
				}
			}
			$html .= '</div>';
		}

		$source = array();

		$doWidgetFolder = DataObject::get_one("File","ClassName = 'Folder' AND Name = 'Uploads'");
		if ($doWidgetFolder) {
			$dosImages = DataObject::get("Image","ParentID = ".$doWidgetFolder->ID);
			if ($dosImages) {
				$source = $dosImages->toDropdownMap('ID','Name');
			}
		}
		else {
			$source = array(0 => 'Please create a folder "widgets" in "Uploads" and upload required images to it');
		}

		$options = array();

		foreach($source as $value => $title) {
			// Blank value of field and source (e.g. "" => "(Any)")
			if($value === '' && ($this->value === '' || $this->value === null)) {
				$selected = 'selected';
			}
			else {
				// Normal value from the source
				if($value) {
					$selected = ($value == $this->value) ? 'selected' : null;
				} else {
					// Do a type check comparison, we might have an array key of 0
					$selected = ($value === $this->value) ? 'selected' : null;
				}

				$this->isSelected = ($selected) ? true : false;
			}

			$options .= $this->createTag(
				'option',
				array(
					'selected' => $selected,
					'value' => $value
				),
				Convert::raw2xml($title)
			);
		}

		$attributes = array(
			'id' => $this->id(),
			'name' => $this->name,
			'tabindex' => $this->getTabIndex()
		);

		$html .= $this->createTag('select', $attributes, $options);
		$html .= "</div>";

		return $html;
	}
}
