import { RichText, useBlockProps } from '@wordpress/block-editor';
import { Button } from '@wordpress/components';
import { registerBlockType } from '@wordpress/blocks';
import type { BlockEditProps } from '@wordpress/blocks';
import metadata from './block.json';
import './editor.scss';

type FaqItem = {
  question: string;
  answer: string;
};

type Attributes = {
  heading: string;
  items: FaqItem[];
};

const Edit = ({ attributes, setAttributes }: BlockEditProps<Attributes>) => {
    const updateItem = (index: number, next: Partial<FaqItem>): void => {
      const items = attributes.items.map((item, itemIndex) =>
        itemIndex === index ? { ...item, ...next } : item,
      );
      setAttributes({ items });
    };

    return (
      <section {...useBlockProps({ className: 'faq-block' })}>
        <RichText
          tagName="h2"
          value={attributes.heading}
          onChange={(heading) => setAttributes({ heading })}
        />
        <div className="faq-block__items">
          {attributes.items.map((item, index) => (
            <div className="faq-block__item" key={index}>
              <RichText
                tagName="h3"
                value={item.question}
                onChange={(question) => updateItem(index, { question })}
              />
              <RichText
                tagName="p"
                value={item.answer}
                onChange={(answer) => updateItem(index, { answer })}
              />
            </div>
          ))}
        </div>
        <Button
          variant="secondary"
          onClick={() =>
            setAttributes({
              items: [...attributes.items, { question: 'New question', answer: 'Answer text.' }],
            })
          }
        >
          Add question
        </Button>
      </section>
    );
};

registerBlockType<Attributes>(metadata.name, {
  ...metadata,
  edit: Edit,
  save: () => null,
});
