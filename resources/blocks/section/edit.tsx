import { InspectorControls, RichText, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { registerBlockType } from '@wordpress/blocks';
import type { BlockEditProps } from '@wordpress/blocks';
import metadata from './block.json';
import './editor.scss';

type Attributes = {
  heading: string;
  lead: string;
  tone: string;
};

const Edit = ({ attributes, setAttributes }: BlockEditProps<Attributes>) => (
    <>
      <InspectorControls>
        <PanelBody title="Appearance">
          <SelectControl
            label="Tone"
            value={attributes.tone}
            options={[
              { label: 'Default', value: 'default' },
              { label: 'Surface', value: 'surface' },
            ]}
            onChange={(tone) => setAttributes({ tone })}
          />
        </PanelBody>
      </InspectorControls>
      <section {...useBlockProps({ className: `section-block section-block--${attributes.tone}` })}>
        <RichText
          tagName="h2"
          value={attributes.heading}
          onChange={(heading) => setAttributes({ heading })}
        />
        <RichText tagName="p" value={attributes.lead} onChange={(lead) => setAttributes({ lead })} />
      </section>
    </>
);

registerBlockType<Attributes>(metadata.name, {
  ...metadata,
  edit: Edit,
  save: () => null,
});
