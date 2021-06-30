<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Notifier\Bridge\RocketChat;

use Symfony\Component\Notifier\Message\MessageOptionsInterface;

/**
 * @author Jeroen Spee <https://github.com/Jeroeny>
 *
 * @see https://rocket.chat/docs/administrator-guides/integrations/
 */
final class RocketChatOptions implements MessageOptionsInterface
{
    private array $options;
    private ?string $channel;

    public function __construct(array $options = [], ?string $channel = null)
    {
        $this->options = $options;
        $this->channel = $channel;

        return $this;
    }

    public function toArray(): array
    {
        return $this->options;
    }

    public function getRecipientId(): ?string
    {
        return $this->channel;
    }
    
    /**
     * @var string $channel prefix with '@' for personal messages
     */
    public function setChannel(string $channel): self
    {
        $this->channel = $channel;

        return $this;
    }

    public function setSenderTitle(string $title): self
    {
        $this->options['username'] = $title;

        return $this;
    }

    public function setIconURL(string $iconURL): self
    {
        $this->options['icon_url'] = $iconURL;

        return $this;
    }

    public function addTextAttachment(string $name, string $content): self
    {
        $this->options['attachments'][] = [
            'title' => $name,
            'text' => $content,
        ];

        return $this;
    }
}
