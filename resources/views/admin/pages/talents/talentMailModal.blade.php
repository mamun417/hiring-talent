<!-- Modal -->
<div class="modal fade" id="talentSendMessageModal" tabindex="-1" role="dialog"
     aria-labelledby="talentSendMessageModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="talentSendMessageModal">Message Send</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.send.message.to-talent') }}" method="post">
                @csrf
                <input type="hidden" id="talentMessageId" name="talent_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="talentEmail">Email</label>
                        <input type="email" class="form-control" name="talent_email" id="talentEmail">
                        @error('talent_email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input class="form-control" id="subject" type="text" name="subject">
                        @error('subject')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message_body">Message</label>
                        <textarea class="form-control" name="message_body" id="message_body" cols="30"
                                  rows="10"></textarea>
                        @error('message_body')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--    mail send to all talents modal--}}
<div class="modal fade" id="sendMailAllTalentModal" tabindex="-1" role="dialog"
     aria-labelledby="sendMailAllTalentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendMailAllTalentModal">Send Mail To All Talent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.send.message.to-talent') }}" method="post">
                @csrf
                <input type="hidden" name="mail_to" value="all">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input class="form-control" id="subject" type="text" name="subject">
                        @error('subject')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message_body">Message</label>
                        <textarea class="form-control" name="message_body" id="message_body" cols="30"
                                  rows="10"></textarea>
                        @error('message_body')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--    mail send to selected talents modal--}}
<div class="modal fade" id="sendMailAllSelectedTalentModal" tabindex="-1" role="dialog"
     aria-labelledby="sendMailAllSelectedTalentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendMailAllSelectedTalentModal">Send Mail To Selected Talent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.send.message.to-talent') }}" method="post">
                @csrf
                <input type="hidden" name="mail_to" value="selected_talents">
                <input type="hidden" name="talents[]" id="selectedTalentField">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input class="form-control" id="subject" type="text" name="subject">
                        @error('subject')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="message_body">Message</label>
                        <textarea class="form-control" name="message_body" id="message_body" cols="30"
                                  rows="10"></textarea>
                        @error('message_body')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
